@extends('layouts.user')

@section('title')
@lang('t.product.formTitle')
@endsection

@section('myContent')
<div class="container-fluid">
    <div class="row">
        <form novalidate class="form w-100 needs-validation"
            action="/{{app()->getLocale()}}/user/{{auth()->id()}}/p"
            method="post" v-on:submit.prevent.stop="h.d.validateForm($event)">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="row form-group pr-1">
                        <label for="catChooser"
                            class="form-label-col d-none d-md-block col-md-4">
                            @lang('t.user.choscat')
                        </label>
                        <select id="catChooser" class="custom-select col-md-8"
                            name="cat" v-on:change="h.d.onCatChange($event)"
                            required>
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
                            class="form-label-col d-none d-md-block col-md-4">
                            @lang('t.user.chossubcat')
                        </label>
                        <select id="subCatChooser"
                            class="custom-select col-md-8" name="subCat"
                            required>
                            <option v-for="(sc, scinx) in h.d.subCat"
                                :value="sc.id">@{{sc.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label for="pname" class="form-label-col col-sm-3">
                    @lang('t.user.pname')
                </label>
                <input type="text" class="form-control col-sm-9" name="name"
                    id="pname" aria-describedby="namehelpId"
                    placeholder=" @lang('t.user.pname')" minlength="1"
                    required />
            </div>
            <div class="row form-group">
                <label for="pbrand" class="form-label-col col-sm-3">
                    @lang('t.user.pbrand')
                </label>
                <input type="text" class="form-control col-sm-9" name="brand"
                    id="pbrand" aria-describedby="brandhelpId"
                    placeholder="@lang('t.user.pbrand')" required />
            </div>
            <div class="row form-group">
                <label for="pinfo" class="form-label-col col-sm-3">
                    @lang('t.user.pinfo')
                </label>
                <textarea type="text" class="form-control col-sm-9" name="info"
                    id="pinfo" placeholder="@lang('t.user.pinfo')"
                    required></textarea>
            </div>
            <div class="row form-group">
                <label for="pprice" class="form-label-col col-sm-3">
                    @lang('t.user.pprice')
                </label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                        <span class="input-group-text">1.00</span>
                    </div>
                    <input type="number" required class="form-control"
                        name="price" id="pprice" aria-describedby="pricehelpId"
                        placeholder="@lang('t.user.pprice')" min="1" step="0.01" />
                </div>
            </div>
            <div class="row form-group">
                <label for="pamount" class="form-label-col col-sm-3">
                    @lang('t.user.pamount')
                </label>
                <input type="number" required class="form-control col-sm-9"
                    name="amount" id="pamount" aria-describedby="amounthelpId"
                    placeholder="@lang('t.user.pamount')" min="1" />
            </div>
            <div class="row form-group">
                <label for="psave" class="form-label-col col-sm-3">
                    @lang('t.user.psave')
                </label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text">0</span>
                    </div>
                    <input type="number" required class="form-control"
                        name="save" id="psave" aria-describedby="savehelpId"
                        placeholder="@lang('t.user.psave')" min="0" max="100" />
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label for="pcolor" class="form-label-col col-sm-3">
                    @lang('t.user.pcolor')
                </label>
                <input type="string" required class="form-control col-sm-9"
                    name="color" id="pcolor" aria-describedby="pcolorhelpId"
                    placeholder="@lang('t.user.pcolor')" />
                <small id="pcolorhelpId" class="text-muted">
                    @lang('t.user.pcolorHelp')
                </small>
            </div>
            <div class="row form-group">
                <div class="custom-control custom-switch col-12">
                    <input type="checkbox" class="custom-control-input"
                        name='is_new' id="isNewProduct" checked>
                    <label class="custom-control-label" for="isNewProduct">
                        @lang('t.user.newProduct')
                    </label>
                </div>
            </div>
            <div class="row form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input"
                        id="productImg">
                    <label class="custom-file-label" for="productImg">
                        @lang('t.user.img')
                    </label>
                </div>
                <strong class="text-danger">
                    * @lang('t.user.noImgTxt')
                </strong>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <button type="reset" class="btn btn-danger">
                        @lang('t.user.resetForm')
                    </button>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">
                        <x-btn-loader showIf="h.d.savingProduct"></x-btn-loader>
                        @lang('t.user.saveProduct')
                    </button>
                </div>
            </div>
        </form>
        <input id="catsData" required type="hidden" class="d-none"
            value="{{$cats->toJson()}}" />
    </div>
</div>
@endsection