@extends('layouts.user')

@section('title')
@lang('t.user.title.order')
@endsection
{{-- @dump($orders[0]) --}}
@section('myContent')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    @foreach ($orders as $order)
    <div class="col mb-4">
        <div class="card">
            <img src="/img/{{$order->product->p_cat->parent->slug}}/{{$order->product->img[0]}}"
                class="card-img-top" alt="{{$order->product->name}}">
            <div class="card-body p-0">
                <h5 class="card-title p-2">
                    <a
                        href="/{{app()->getLocale()}}/p/{{$order->product->slug}}">
                        {{$order->product->name}}
                    </a>
                </h5>
                <p class="card-text">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong><i
                                    class="fa fas fa-address-card text-danger"></i></strong>
                            {{$order->address}}
                        </li>
                        <li class="list-group-item">
                            <strong
                                class="text-danger">@lang('t.user.amount'):</strong>
                            {{$order->amount}}
                        </li>
                        <li class="list-group-item">
                            ${{number_format($order->total, 2)}}
                        </li>
                        <li class="list-group-item">
                            <strong
                                class="text-danger">@lang('t.user.sent'):</strong>
                            <i
                                class="font-weight-bolder fa fas fa-{{$order->sent ? 'check text-success' : 'times text-danger'}}"></i>
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    @endforeach
    {{$orders->links()}}
</div>
@endsection