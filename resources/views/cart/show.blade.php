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
        <div class="card mb-3" v-for="(c, cinx) in h.d.cart">
            <div class="row no-gutters p-2">
                <div class="col-sm-4">
                    <span class="badge badge-danger p-2 position-absolute"
                        v-if="c.product.save">
                        @lang('t.offTxt') @{{c.product.save}} %
                    </span>
                    <img :src="'/img/' + c.product.img[0]"
                        class="card-img pt-3 pl-1" alt="">
                </div>
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a :href="'/p/' + c.product.slug">
                                @{{c.product.slug}}
                            </a>
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p
                                    class="card-text text-primary font-weight-bold">
                                    <span class="d-block">
                                        @{{c.total}}
                                    </span>
                                    <span class="text-muted"
                                        v-if="c.amount > 1">
                                        @{{c.product.savedPrice}}
                                        @lang('t.scart.per')
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <select class="custom-select col-5"
                                    name="cartAmount"
                                    v-on:change="h.d.changeAmount($event, cinx, c.product.savedPrice, c.product.id)">
                                    <option
                                        v-for="i in [...Array(c.product.amount).keys()]"
                                        :value="i+1"
                                        :selected="i+1 === c.amount">@{{i+1}}
                                    </option>
                                </select>
                                <p class="text-danger font-weight-bold">
                                    @lang('t.show.stock')
                                    @{{c.product.amount}}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-muted">
                                <p>
                                    <strong>@lang('t.show.cond'):</strong>
                                    <span v-if="c.product.is_used">
                                        {{__('t.show.used')}}
                                    </span>
                                    <span v-else>
                                        {{__('t.show.new')}}
                                    </span>
                                </p>
                                <p>
                                    <strong>@lang('t.show.color'):</strong>
                                    <span>@{{c.product.color[0]}}</span>
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
    </div>
    <div class="col-12 col-sm-4">
        <div class="position-sticky">
            <div class="row col-md-10">
                <div class="card card-body">
                    <h5>
                        <span class="d-block">@lang('t.index.overTotal'):
                        </span>
                        <div class="btn-group">
                            <button class="btn btn-clear" type="button">
                                <h4 class="text-primary">
                                    <x-btn-loader showIf='h.d.cartLoader'></x-btn-loader>
                                    @{{h.d.totalPrice}}
                                </h4>
                            </button>
                            <button type="button"
                                class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu p-2">
                                <a class="dropdown-item" href="#"
                                    v-on:click.prevent="h.d.convertTo('EGP')">
                                    @lang('t.show.conTo') @lang('t.show.EGP')
                                </a>
                                <a class="dropdown-item" href="#"
                                    v-on:click.prevent="h.d.convertTo('EUR')">@lang('t.show.conTo')
                                    @lang('t.show.EU')</a>
                                <a class="dropdown-item" href="#"
                                    v-on:click.prevent="h.d.convertTo('USD')">@lang('t.show.conTo')
                                    @lang('t.show.USD')</a>
                            </div>
                        </div>
                    </h5>
                </div>
                <a href="#" class="btn btn-lg btn-block btn-primary mt-3">
                    @lang('t.index.checkout')
                </a>
            </div>
        </div>
    </div>

</div>
<div :class="h.d.cartLoader ? 'd-flex' : 'd-none'"
    class="d-none justify-content-center mt-2">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"
        role="status">
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
@endsection