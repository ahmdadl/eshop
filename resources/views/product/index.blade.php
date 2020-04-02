@extends('layouts.app', ['cpt' => 'product'])

@section('title')
@lang('t.all_p')
@endsection

@section('content')
<div class="row">
    <div class="col-6 col-sm-4 col-md-3 col-lg-2" v-for="p in h.d.data">
        <div class="card">
            <img :src="'/img/' + p.img[0]" class="card-img-top"
                :alt="p.name +' image'">
            <div class="card-body">
                <p>
                    <span class="badge badge-danger">
                        @{{p.save}} % OFF
                    </span>
                </p>
                <h5 class="card-title">@{{p.name}}</h5>
                <p class="card-text">
                    <strong class="text-primary">
                        @{{p.savedPrice}} USD

                        <span v-if="p.save"
                            class="d-block text-muted text-dell">
                            @{{p.price}} USD
                        </span>

                    </strong>
                </p>
                <p>
                    <star-rate :percent="p.rateAvg" :count="p.rates.length"></star-rate>
                </p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
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