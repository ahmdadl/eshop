@extends('layouts.app', ['cpt' => 'product'])

@section('title')
{{$title ?? __('t.all_p')}}
@endsection

@section('content')
<div class="row">
    <div class="col-6 text-left">
        <h4>{{$title}}</h4>
    </div>
    <div class="col-6 text-right">
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
    </div>
</div>
<div class="row">
    <my-product v-for="(p, pinx) in h.d.data" :product="p"
        :lang="['@lang('t.offTxt')', '@lang('t.addCart')', '@lang('t.youSave')']"
        :is_land="h.d.is_land_product" :key="pinx">
    </my-product>
</div>
<div :id="h.d.loadingPosts" class="d-flex justify-content-center mt-2">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"
        role="status">
        <div class="spinner-grow text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
@endsection