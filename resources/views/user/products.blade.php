@extends('layouts.user')

@section('title')
@lang('t.user.title.prod')
@endsection

@section('myContent')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    @foreach ($products as $product)
    <div id="card{{$loop->index}}" class="col mb-4">
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
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a href="/{{app()->getLocale()}}/user/{{auth()->id()}}/p/{{$product->slug}}/edit"
                            class="btn btn-info btn-sm">
                            <i class="fa fas fa-edit"></i>
                            @lang('t.user.edit')
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger btn-sm"
                            v-on:click="h.d.deleteProduct('{{$product->slug}}', '{{$product->id}}', '{{$loop->index}}')">
                            <x-btn-loader :id="'spinner'.$product->id">
                            </x-btn-loader>
                            <i class="fa fas fa-times"></i>
                            @lang('t.user.delete')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{$products->links()}}
</div>
<input type="hidden" class="d-none" id="userLang"
    value="{{json_encode([__('t.user.mes.del')])}}" />
@endsection