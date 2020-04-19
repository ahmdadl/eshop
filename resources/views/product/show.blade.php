@extends('layouts.app', ['cpt' => 'show-product'])

@section('title')
{{$p->brand}}-{{$p->name}}
@endsection
{{-- @dump($p) --}}
@section('content')
@if ($p->amount < 1) <div
    class="d-flex justify-content-center alert alert-danger">
    <strong>@lang('t.show.out')</strong>
    </div>
    @endif

    <div class="col-12 col-md-9">
        <div class="row">
            <div class="col-12">
                <h3>{{$p->brand}}-{{$p->name}}</h3>
                <hr />
            </div>
        </div>
        <div class="row">
            @if ($p->save)
            <span class="position-absolute badge badge-danger p-2" style="z-index: 55;font-size: small" dir="ltr">
                {{$p->save}} %  {{__('t.offTxt')}}
            </span>
            @endif
            <div class="col-12">
                <x-img-slider :slug="$p->pCat->parent->slug" :imgArr="$p->img">
                </x-img-slider>
            </div>
        </div>

        @include('product.show.info')
        @include('product.show.social')
        @include('product.show.spec')
        @include('product.show.rev')
    </div>

    @endsection