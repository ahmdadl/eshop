@extends('layouts.user')

@section('title')
@lang('t.user.title.prod')
@endsection

@section('myContent')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    @foreach ($products as $product)
    <div class="col mb-4">
        <div class="card">
            <img src="/img/{{$product->img[0]}}" class="card-img-top"
                alt="{{$product->slug}}">
            <div class="card-body">
                <h5 class="card-title">
                    <a
                        href="/{{app()->getLocale()}}/p/{{$product->slug}}">{{$product->name}}</a>
                </h5>
                <p class="card-text">
                    <star-rate :percent="{{$product->rateAvg}}"></star-rate>
                </p>
                <p>
                    @lang('t.user.sales'):
                    <strong>
                        {{\number_format($product->orders->count())}}
                    </strong>
                </p>
                <p class="text-primary">
                    <strong>
                        ${{\number_format($product->savedPrice, 2)}}
                    </strong>
                </p>
            </div>
        </div>
    </div>
    @endforeach
    {{$products->links()}}
</div>
@endsection