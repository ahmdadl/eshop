@extends('layouts.app', ['cpt' => 'home'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <nav class="nav flex-column">
                <a class="nav-link bg-primary text-light rounded"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}">@lang('t.user.profile')</a>
                <a class="nav-link @if (request()->is('*/user/*/orders')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/orders">
                    @lang('t.user.order')
                </a>
                <a class="nav-link @if (request()->is('*/user/*/sell')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/sell">
                    @lang('t.user.sellItem')
                </a>
            </nav>
        </div>
        <div class="col-sm-9">
            @yield('myContent')
        </div>
    </div>
</div>
@endsection