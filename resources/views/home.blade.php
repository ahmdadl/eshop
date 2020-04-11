@extends('layouts.app', ["cpt" => 'home'])

@section('title')
{{__('t.home.title')}}
@endsection

@section('content')
<div class="container-fluid">
@foreach ($cats as $cat)
<h3 class="mt-5 text-primary text-uppercase">
    <strong>{{$cat->name}}:</strong>
</h3>
<div class="row row-cols-2 row-cols-sm-3 row-cols-md-6">
    @foreach ($cat->subCat as $c)
    @php
    $c->load(['productsMini'=>function($query) {
    return $query->take(1);
    }]);
    @endphp
    @foreach ($c->productsMini as $p)
    <div class="card p-0 mt-3">
        @if ($p->save)
        <span class="position-absolute badge badge-danger p-2">
            {{$p->save}} % @lang('t.offTxt')
        </span>
        @endif
        <img src="/img/{{$cat->slug}}/{{$p->img[0]}}" class="card-img-top"
            alt="{{$p->slug}}">
        <div class="card-body">
            <h5 class="card-title">
                <a href="/{{app()->getLocale()}}/p/{{$p->slug}}">
                    {{$p->name}}
                </a>
            </h5>
            <p class="card-text text-primary">
                <strong>
                    ${{\number_format($p->savedPrice, 2)}}
                </strong>
                @if ($p->save)
                <strong class="text-muted d-block">
                    <del>${{\number_format($p->price, 2)}}</del>
                </strong>
                @endif
            </p>
            <p>
                <star-rate :percent="{{$p->rateAvg}}"
                    :count="{{$p->rates->count()}}"></star-rate>
            </p>
        </div>
    </div>
    @endforeach
    @endforeach
</div>
@endforeach
</div>
@endsection