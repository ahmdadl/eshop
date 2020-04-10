@extends('layouts.app', ['cpt' => 'user-profile'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 mb-4">
            <nav class="nav flex-column">
                <a class="nav-link @if (request()->is('*/user/*/profile')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/profile">@lang('t.user.menu.profile')</a>
                <a class="nav-link @if (request()->is('*/user/*/orders')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/orders">
                    @lang('t.user.menu.order')
                </a>
                <a class="nav-link @if (request()->is('*/user/*/products')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/products">
                    @lang('t.user.menu.prod')
                </a>
                <a class="nav-link @if (request()->is('*/user/*/p/create')) bg-primary text-light rounded @endif"
                    href="/{{app()->getLocale()}}/user/{{auth()->id()}}/p/create">
                    @lang('t.user.menu.sellItem')
                </a>
            </nav>
        </div>
        <div class="col-sm-9">
            @yield('myContent')
        </div>
    </div>
</div>
@endsection