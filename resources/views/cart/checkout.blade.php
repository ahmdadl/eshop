@extends('layouts.app', ['cpt' => 'home'])

@section('title')
@lang('t.check.title')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-10 col-md-8">
        @unless (Session::has('success') && Session::get('success', false))
        <form action="/{{app()->getLocale()}}/cart/checkout" method="post"
            class="need-validation was-validated">
            @csrf
            <div class="row form-group">
                <label for="fname"
                    class="col-sm-3 col-form-label">@lang('t.check.fname')</label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span id="fnameHelp" class="input-group-text">
                            <i class="fa fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="fname"
                        id="fname" aria-describedby="fnameHelp"
                        placeholder="@lang('t.check.fname')"
                        value="{{$userName[0]}}" required>
                </div>
            </div>
            <div class="row form-group">
                <label for="lname"
                    class="col-sm-3 col-form-label">@lang('t.check.lname')</label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="lnameHelp">
                            <i class="fa fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="lname"
                        id="lname" aria-describedby="lnameHelp"
                        placeholder="@lang('t.check.lname')"
                        value="{{$userName[1]}}" required>
                </div>

            </div>
            <div class="row form-group">
                <label for="address"
                    class="col-sm-3 col-form-label">@lang('t.check.address')</label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addressHelp">
                            <i class="fa fas fa-address-card"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="address"
                        id="address" aria-describedby="addressHelp"
                        placeholder="@lang('t.check.address')"
                        value="{{$address}}" required>
                </div>

            </div>
            <div class="row form-group">
                <label for="card"
                    class="col-sm-3 col-form-label">@lang('t.check.card')</label>
                <div class="input-group col-sm-9">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="cardHelp">
                            <i class="fa fas fa-credit-card"></i>
                        </span>
                    </div>
                    <input type="number" class="form-control" name="card"
                        id="card" aria-describedby="cardHelp"
                        placeholder="@lang('t.check.card')" value="{{$card}}"
                        required>
                </div>

            </div>
            <div class="form-group">
                <button type="submit"
                    class="btn btn-primary btn-block col-sm-8">
                    @lang('t.check.save')
                </button>
            </div>
        </form>
        @else
        <div class="alert alert-success text-center">
            <p>
                <i
                    class="fa fas fa-check border border-dark rounded-circle p-3 fa-2x"></i>
            </p>
            <strong>
                @lang('t.check.success')
            </strong>
        </div>
        @endunless
    </div>
</div> @endsection