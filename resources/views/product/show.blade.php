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

    <h3>{{$p->brand}} {{$p->name}}</h3>
    <hr />
    <x-img-slider :imgArr="$p->img"></x-img-slider>
    
@endsection