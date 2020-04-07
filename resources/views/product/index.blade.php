@extends('layouts.app', ['cpt' => 'product'])

@section('title')
{{$title ?? __('t.all_p')}}
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 text-left">
        <h4>{{$title}}</h4>
    </div>
    <div class="col-12 col-sm-6 text-right">
        @lang('t.view')
        <div class="d-inline">
            <button class="btn btn-outline-primary"
                v-on:click.prevent="h.d.is_land_product = true"
                :class="h.d.is_land_product ? 'active' : ''">
                <i class="fa fa-bars"></i>
            </button>
            <button class="btn btn-outline-primary"
                v-on:click.prevent="h.d.is_land_product = false"
                :class="h.d.is_land_product ? '' : 'active'">
                <i class="fa fa-th-large"></i>
            </button>
        </div>
        <span>
            @lang('t.sortBy'): <div class="btn-group dropleft">
                <div class="dropdown d-inline">
                    <button
                        class="btn btn-outline-info btn-clear dropdown-toggle text-capitalize"
                        type="button" id="dropdownMenuFilterList"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @{{h.d.filters[h.d.currentFilter]}}
                    </button>
                    <div class="dropdown-menu text-capitalize"
                        aria-labelledby="dropdownMenuFilterList">
                        <a class="dropdown-item" href="#"
                            v-for="(f, finx) in h.d.filters"
                            v-on:click.prevent="h.d.filterData(finx+1)"
                            :class="h.d.currentFilter===finx ? 'active' : ''">@{{f}}</a>
                    </div>
                </div>
            </div>
        </span>
    </div>
</div>
<div class="row mt-3">
    @unless ($slug[0] === 'search')
    <div class="d-none d-md-block col-12 col-md-2">
        <div class="card px-0">
            <div class="card-header px-0">
                <button class="btn btn-info btn-sm float-left"
                    :disabled="h.d.loadingPosts">
                    @lang('t.nav.daily')
                </button>
                <button class="btn btn-danger float-right btn-sm"
                    v-on:click="h.d.removeAllfilters()" :disabled="h.d.loadingPosts || (!h.d.selected.brands.length && !h.d.selected.colors.length && !h.d.selected.conditions.length &&
                    h.d.oldData.length === h.d.data.length)">
                    <x-btn-loader showIf="h.d.loadingPosts"></x-btn-loader>
                    @lang('t.removeAllfillters')
                </button>
            </div>
        </div>
        <x-filter-card title="Brand" show="show">
            <x-loop-filters data="brands" index="br"></x-loop-filters>
        </x-filter-card>
        <x-filter-card title="Color">
            <x-loop-filters data="colors" index="co"></x-loop-filters>
        </x-filter-card>
        <x-filter-card title="Condition">
            <x-loop-filters data="conditions" index="cod" type="radio">
            </x-loop-filters>
        </x-filter-card>
        @include('product.filters.range')
        @include('product.filters.rating')
    </div>
    @endunless
    <div class="col-12 col-md-10 card-group">
        <div class="alert alert-danger mt-5" v-if="!h.d.oldData.length">
            @lang('t.show.noPros')
        </div>
        <my-product v-for="(p, pinx) in h.d.data" :product="p"
            :lang="['@lang('t.offTxt')', '@lang('t.addCart')', '@lang('t.youSave')']"
            :is_land="h.d.is_land_product" :key="pinx">
        </my-product>
    </div>
</div>
<div :class="h.d.loadingPosts ? 'd-flex' : 'd-none'"
    class="d-none justify-content-center mt-2">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"
        role="status">
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<input type="hidden" id="prosData" value="{{$pros->toJson()}}" />
@endsection