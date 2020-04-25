@extends('layouts.user')

@section('title')
@lang('t.user.menu.clients')
@endsection

@section('myContent')
<div class="alert alert-info">
    <strong>
        try in our online api console
        <a href="/{{app()->getLocale()}}/console" class="btn btn-outline-primary ml-3">
            visit api console
        </a>
    </strong>
</div>
<passport-clients></passport-clients>
@endsection