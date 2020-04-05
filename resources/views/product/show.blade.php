@extends('layouts.app', ['cpt' => 'show-product'])

@section('title')
{{$p->brand}}-{{$p->name}}
@endsection

@section('content')
@if ($p->amount < 1) <div
    class="d-flex justify-content-center alert alert-danger">
    <strong>@lang('t.show.out')</strong>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <h3>{{$p->brand}} {{$p->name}}</h3>
            <hr />
        </div>
    </div>
    <div class="row">
        <x-img-slider :imgArr="$p->img"></x-img-slider>
    </div>
    <div class="row pt-5">
        <div class="col-12 col-sm-6">
            <h4 class="text-primary">${{number_format($p->savedPrice, 2)}}</h4>
            @if ($p->save)
            <h5><del class="text-muted">${{\number_format($p->price, 2)}}</del></h5>
            @endif
            <p>
                <strong>@lang('t.show.color'):</strong>
                <span class="p-1 px-2 border border-dark">{{$p->color[0]}}</span>
            </p>
            <p>
                <strong class="d-block">@lang('t.show.desc')</strong>
                <span>{{$p->info}}</span>
            </p>
        </div>
        <div class="col-12 col-sm-6">
            <div class="d-block">
                <button class="btn btn-primary btn-block mb-2">
                    @lang('t.addCart')
                </button>
                <strong class="text-danger">{{$p->amount}} @lang('t.show.stock')</strong>
            </div>
            <hr />
            <div class="d-block">
                <p>
                    <strong>@lang('t.show.cond'):</strong>
                    <span>
                        {{$p->is_used ? __('t.show.used') : __('t.show.new')}}
                    </span>
                </p>
                <p>
                    <strong>@lang('t.show.soldBy'):</strong>
                    <span>
                        {{$p->user->name}}
                    </span>
                </p>
            </div>
        </div>
    </div>
    @endsection