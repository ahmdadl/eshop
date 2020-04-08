@extends('layouts.app', ['cpt' => 'show-cart'])

@section('title')
@lang('t.scart.shopp')
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-8">
        <h4>
            @lang('t.scart.shopp')
            ({{sizeof($cart)}})
        </h4>
        @foreach ($cart as $c)
        @php $c = (object)$c @endphp
        <div class="card mb-3">
            <div class="row no-gutters p-2">
                <div class="col-sm-4">
                    @if ($c->product['save'] > 0)
                    <span class="badge badge-danger p-2 position-absolute">
                        @lang('t.offTxt') {{$c->product['save']}} %
                    </span>
                    @endif
                    <img src="/img/{{$c->product['img'][0]}}"
                        class="card-img pt-3 pl-1" alt="...">
                </div>
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/p/{{$c->product['slug']}}">
                                {{$c->product['name']}}
                            </a>
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p
                                    class="card-text text-primary font-weight-bold">
                                    <span class="d-block">
                                        ${{\number_format($c->total, 2)}}
                                    </span>
                                    @if ($c->amount > 1)
                                    <span class="text-muted">
                                        ${{\number_format($c->product['savedPrice'], 2)}}
                                        @lang('t.scart.per')
                                    </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <select class="custom-select col-5"
                                    name="cartAmount">
                                    @foreach (range(1, $c->product['amount']) as
                                    $i)
                                    <option :value='{{$i}}'
                                        {{$i === $c->amount ? 'selected' : ''}}>
                                        {{$i}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger font-weight-bold">
                                    @lang('t.show.stock')
                                    {{$c->product['amount']}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-muted">
                                <p>
                                    <strong>@lang('t.show.cond'):</strong>
                                    <span>
                                        {{$c->product['is_used'] ? __('t.show.used') : __('t.show.new')}}
                                    </span>
                                </p>
                                <p>
                                    <strong>@lang('t.show.color'):</strong>
                                    <span>{{$c->product['color'][0]}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 border-top pt-2">
                    <button
                        class="btn btn-outline-danger text-uppecase">@lang('t.scart.del')</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-12 col-sm-4">
        <div class="position-fixed">
            <div class="row col-md-10">
                <div class="card card-body">
                    <h5>
                        @lang('t.index.overTotal'):
                        <strong class="text-primary">
                            {{$c->total}}
                        </strong>
                    </h5>
                </div>
                <a href="#" class="btn btn-lg btn-block btn-primary mt-3">
                    @lang('t.index.checkout')
                </a>
            </div>
        </div>
    </div>
</div>
@endsection