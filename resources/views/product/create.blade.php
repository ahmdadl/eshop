@extends('layouts.user')

@section('title')
@lang('t.product.formTitle')
@endsection

@section('myContent')
<div class="container-fluid">
    <div class="row">
        <form class="form w-100"
            action="/{{app()->getLocale()}}/user/{{auth()->id()}}/p"
            method="post">
            @csrf
            <input id="catsData" type="hidden" class="d-none"
                value="{{$cats->toJson()}}" />
            <div class="row">
                <div class="col-sm-6">
                    <div class="row form-group pr-1">
                        <label for="catChooser"
                            class="form-label-col d-none d-md-block col-md-3">
                            @lang('t.user.choscat')
                        </label>
                        <select id="catChooser" class="custom-select col-md-9"
                            name="cat" v-on:change="h.d.onCatChange($event)">
                            <option selected>
                                @lang('t.user.choscat')
                            </option>
                            @foreach ($cats as $cat)
                            <option value="{{$cat->id}}">
                                {{$cat->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row form-group pl-1">
                        <label for="subCatChooser"
                            class="form-label-col d-none d-md-block col-md-3">
                            @lang('t.user.chossubcat')
                        </label>
                        <select id="subCatChooser"
                            class="custom-select col-md-9" name="subCat">
                            <option v-for="(sc, scinx) in h.d.subCat"
                                :value="sc.id">@{{sc.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label for="" class="form-label-col"></label>
                <input type="text" class="form-control" name="" id=""
                    aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help
                    text</small>
            </div>
        </form>
    </div>
</div>
@endsection