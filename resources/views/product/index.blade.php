@extends('layouts.app', ['cpt' => 'product'])

@section('title')
@lang('t.all_p')
@endsection

@section('content')
<div class="row">
    <my-product v-for="(p, pinx) in h.d.data" :product="p"
        :lang="['@lang('t.offTxt')', '@lang('t.addCart')', '@lang('t.youSave')']" :is_land="true"
        :key="pinx">
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