<!doctype html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="shop,ecommerce,ecommerce laravel,ecommerce website,laravel shop,larave ecommerce,online shop">
    <meta name="description" content="an laravel ecommerce app">
    <meta name="author" content="Ahmed Adel">

    <title>@yield('title', 'eshop')</title>

    <style>
        .sk-cube-grid {
            width: 40px;
            height: 40px;
            margin: 100px auto
        }

        .sk-cube-grid .sk-cube {
            width: 33%;
            height: 33%;
            background-color: #fff;
            float: left;
            -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out
        }

        .sk-cube-grid .sk-cube1 {
            -webkit-animation-delay: .2s;
            animation-delay: .2s
        }

        .sk-cube-grid .sk-cube2 {
            -webkit-animation-delay: .3s;
            animation-delay: .3s
        }

        .sk-cube-grid .sk-cube3 {
            -webkit-animation-delay: .4s;
            animation-delay: .4s
        }

        .sk-cube-grid .sk-cube4 {
            -webkit-animation-delay: .1s;
            animation-delay: .1s
        }

        .sk-cube-grid .sk-cube5 {
            -webkit-animation-delay: .2s;
            animation-delay: .2s
        }

        .sk-cube-grid .sk-cube6 {
            -webkit-animation-delay: .3s;
            animation-delay: .3s
        }

        .sk-cube-grid .sk-cube7 {
            -webkit-animation-delay: 0s;
            animation-delay: 0s
        }

        .sk-cube-grid .sk-cube8 {
            -webkit-animation-delay: .1s;
            animation-delay: .1s
        }

        .sk-cube-grid .sk-cube9 {
            -webkit-animation-delay: .2s;
            animation-delay: .2s
        }

        @-webkit-keyframes sk-cubeGridScaleDelay {

            0%,
            100%,
            70% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1)
            }

            35% {
                -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1)
            }
        }

        @keyframes sk-cubeGridScaleDelay {

            0%,
            100%,
            70% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1)
            }

            35% {
                -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1)
            }
        }

        pre.line-numbers,
        code {
            direction: ltr
        }

    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @if (app()->isLocale('ar'))
    <link rel="stylesheet"
        href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If"
        crossorigin="anonymous">
    @else
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    @endif
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @if (app()->isLocale('ar'))
    <style>
        .star.star-filled {
            right: 0 !important
        }

    </style>
    @endif
</head>

<body>
    <div id="app">
        <{{$cpt ?? 'home'}} ref="childCmp">
            <template v-slot="h">
                <ul class="nav justify-content-end bg-dark text-light col-12">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ LaravelLocalization::localizeUrl('register') }}">
                            @lang('t.nav.account_create')
                        </a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="{{ LaravelLocalization::localizeUrl('daily') }}">
                            @lang('t.nav.daily')
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link text-light"
                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/p/create">
                            @lang('t.nav.sellUs')
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        @if (app()->isLocale('en'))
                        <a class="nav-link text-light" rel="alternate"
                            hreflang="ar" href="/ar{{
                        Str::after(url()->current(), LaravelLocalization::getCurrentLocale())
                    }}">العربية
                        </a>
                        @else
                        <a class="nav-link text-light" rel="alternate"
                            hreflang="en" href="/en{{
                        Str::after(url()->current(), LaravelLocalization::getCurrentLocale())
                    }}">English
                        </a>
                        @endif
                    </li>
                </ul>
                <nav
                    class="navbar sticky-top navbar-expand-md navbar-dark bg-primary shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <ul class="unstyled-list">
                            <li
                                class="nav-item dropdown float-left d-inline text-light d-md-none">
                                <a id="cartDropdown"
                                    class="nav-link dropdown-toggle text-light"
                                    href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <span v-if="h.d.cartLoader"
                                        class="spinner-grow bg-light"
                                        role="status" aria-hidden="true"></span>
                                    <i class="fa fas fa-cart-plus fa-2x"></i>
                                    <sup class="badge badge-danger">
                                        @{{h.d.cart.length}}
                                    </sup>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="cartDropdown" style="width: 27rem;    overflow-y: scroll;
                                    max-height: 57vh;">
                                    <ul class="list-unstyled">
                                        <li class="media border-bottom py-1"
                                            v-for="c in h.d.cart">
                                            <img :src="'/img/' + c.product.p_cat.parent.slug + '/' + c.product.img[0]"
                                                style="width: 7rem;"
                                                class="align-self-center mr-3 border p-1 border-light"
                                                :alt="c.product.name">
                                            <div class="media-body pr-1">
                                                <h5 class="mt-0">
                                                    <a
                                                        :href="'/p/' + c.product.slug">
                                                        @{{c.product.name}}
                                                    </a>
                                                </h5>
                                                <p>
                                                    <span class="float-left">
                                                        @lang('t.index.QTY'):
                                                        @{{c.amount}}
                                                    </span>
                                                    <span
                                                        class="float-right text-danger">
                                                        @{{c.product.amount}}
                                                        @lang('t.index.stock')
                                                    </span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="mt-5">
                                            <h5
                                                class="text-center font-weight-bolder">
                                                @lang('t.index.overTotal')
                                                <span dir='ltr'
                                                    style="font-size: large;">@{{h.d.cartTotal}}</span>
                                            </h5>
                                            <div class="form-group text-center">
                                                <a href="/{{app()->getLocale()}}/viewCart"
                                                    class="btn btn-secondary col-5">
                                                    @lang('t.index.viewC')
                                                </a>
                                                <a href="/{{app()->getlocale()}}/cart/checkout"
                                                    class="btn btn-success col-5">
                                                    @lang('t.index.checkout')
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown float-left d-inline">
                                <button class="navbar-toggler" type="button"
                                    data-toggle="collapse"
                                    data-target="#navbarSupportedContent"
                                    aria-controls="navbarSupportedContent"
                                    aria-expanded="false"
                                    aria-label="{{ __('Toggle navigation') }}">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </li>
                        </ul>



                        <div class="collapse navbar-collapse"
                            id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <form action="/{{app()->getLocale()}}/p/ser"
                                method="GET" class="form form-inline col-md-9">
                                <div class="form-group col-8">
                                    <input type="search"
                                        class="form-control col-12" name="q"
                                        placeholder="@lang('t.show.serpl')"
                                        value="{{request()->old('q')}}" />
                                </div>
                                <div class="form-group col-4">
                                    <button type="submit"
                                        class="btn btn-outline-info ml-1">
                                        <i class="fa fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('login') }}">{{ __('t.Login') }}</a>
                                </li>
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown"
                                        class="nav-link dropdown-toggle"
                                        href="#" role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span
                                            class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/profile">
                                            @lang('t.index.profile')
                                        </a>
                                        <a class="dropdown-item"
                                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/orders">
                                            @lang('t.index.orders')
                                        </a>
                                        <a class="dropdown-item"
                                            href="/{{app()->getLocale()}}/user/{{auth()->id()}}/products">
                                            @lang('t.index.products')
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('t.Logout') }}
                                        </a>

                                        <form id="logout-form"
                                            action="{{ route('logout') }}"
                                            method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                                <li class="nav-item dropdown d-none d-md-block">
                                    <a id="cartDropdown"
                                        class="nav-link dropdown-toggle"
                                        href="#" role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <span v-if="h.d.cartLoader"
                                            class="spinner-grow bg-light"
                                            role="status"
                                            aria-hidden="true"></span>
                                        <i
                                            class="fa fas fa-cart-plus fa-2x"></i>
                                        <sup class="badge badge-danger">
                                            @{{h.d.cart.length}}
                                        </sup>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="cartDropdown" style="width: 27rem;    overflow-y: scroll;
                                        max-height: 57vh;">
                                        <ul class="list-unstyled">
                                            <li class="media border-bottom py-1"
                                                v-for="c in h.d.cart">
                                                <img :src="'/img/' + c.product.p_cat.parent.slug + '/' + c.product.img[0]"
                                                    style="width: 7rem;"
                                                    class="align-self-center mr-3 border p-1 border-light"
                                                    :alt="c.product.name">
                                                <div class="media-body pr-1">
                                                    <h5 class="mt-0">
                                                        <a
                                                            :href="'/p/' + c.product.slug">
                                                            @{{c.product.name}}
                                                        </a>
                                                    </h5>
                                                    <p>
                                                        <span
                                                            class="float-left">
                                                            @lang('t.index.QTY'):
                                                            @{{c.amount}}
                                                        </span>
                                                        <span
                                                            class="float-right text-danger">
                                                            @{{c.product.amount}}
                                                            @lang('t.index.stock')
                                                        </span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="mt-5">
                                                <h5
                                                    class="text-center font-weight-bolder">
                                                    @lang('t.index.overTotal')
                                                    <span dir='ltr'
                                                        style="font-size: large;">@{{h.d.cartTotal}}</span>
                                                </h5>
                                                <div
                                                    class="form-group text-center">
                                                    <a href="/{{app()->getLocale()}}/viewCart"
                                                        class="btn btn-secondary col-5">
                                                        @lang('t.index.viewC')
                                                    </a>
                                                    <a href="/{{app()->getlocale()}}/cart/checkout"
                                                        class="btn btn-success col-5">
                                                        @lang('t.index.checkout')
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                @if (isset($cats))
                <ul class="nav nav-taps nav-fill navbar-light"
                    style="background-color: #e3f2fd" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{LaravelLocalization::localizeUrl('/')}}">All
                            Categories</a>
                    </li>
                    @foreach ($cats as $c)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{$c->name}}
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($c->subCat as $sc)
                            <a class="dropdown-item"
                                href="{{LaravelLocalization::localizeUrl('c/'.$c->slug.'/sub/'.$sc->slug)}}"
                                @if($cpt==='product' )
                                v-on:click.prevent="$refs.childCmp.loadData('{{$sc->slug}}', null, '{{'/' .app()->getLocale() .'/c/'. $c->slug}}')"
                                @endif>
                                {{$sc->name}}
                            </a>
                            @endforeach
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
                <input id="xlang" type="hidden" value="{{json_encode([
                    __('t.show.errMess'), __('t.show.succMess'), __('t.show.alertTitle'), __('t.show.dangerTitle'), __('t.show.succTitle')
                    ])}}" />
                <main class="py-4 container-fluid" id="component-container">

                    @yield('content')


                </main>
                @include('footer')
            </template>
        </{{$cpt ?? 'home'}}>
        <div style="position: fixed; top: 0;left: 0; z-index:9999; width: 100%; height: 100%; background-color: #343a40"
            ref="splashScreen">
            <div style="position: relative">
                <div
                    style="display: flex; justify-content: center; align-items: center;height: 100vh;">
                    <div class="sk-cube-grid">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                        <div class="sk-cube sk-cube3"></div>
                        <div class="sk-cube sk-cube4"></div>
                        <div class="sk-cube sk-cube5"></div>
                        <div class="sk-cube sk-cube6"></div>
                        <div class="sk-cube sk-cube7"></div>
                        <div class="sk-cube sk-cube8"></div>
                        <div class="sk-cube sk-cube9"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    {{-- <script src="https://js.pusher.com/5.1/pusher.min.js"></script> --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.27/dist/bootstrap-native-v4.min.js">
    </script>
</body>

</html>