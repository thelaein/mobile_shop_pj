<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
 <style>
     .cart-style {
         width: 50px;
         height: 50px;
     }
 </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main-utils.css') }}" rel="stylesheet">
</head>
<body style="display: flex;min-height: 100vh;flex-direction: column;">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm ">
        <div class="container ">
            @guest
                <a class="navbar-brand" href="{{ url('/shop/welcome') }}">
                    <img src="{{asset('images/cart.png')}}" alt="Logo" width="30" height="24"
                         class="d-inline-block align-text-top"> &nbsp;
                    <b>{{ config('app.name', 'Laravel') }}</b>
                </a>
            @endguest
            @if(\Illuminate\Support\Facades\Auth::check())
                @if(\Illuminate\Support\Facades\Auth::user()->isRegisterUser())
                    <a class="navbar-brand" href="{{ url('/shop/welcome') }}">
                        <img src="{{asset('images/cart.png')}}" alt="Logo" width="30" height="24"
                             class="d-inline-block align-text-top"> &nbsp;
                        <b>{{ config('app.name', 'Laravel') }}</b>
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                        <img src="{{asset('images/cart.png')}}" alt="Logo" width="30" height="24"
                             class="d-inline-block align-text-top"> &nbsp;
                        <b>{{ config('app.name', 'Laravel') }}</b>
                    </a>
                @endif
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->isRegisterUser())
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('products/get-mobile-phones*')? 'active' : '' }}"
                                   href="{{url('/products/get-mobile-phones')}}">
                                    Mobile Phones
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('products/get-accessories*')? 'active' : '' }}"
                                   href="{{url('/products/get-accessories')}}">
                                    Accessories
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('products/get-mobile-phones*')? 'active' : '' }}"
                                   href="{{url('/products/get-mobile-phones/admin')}}">
                                    Mobile Phones
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('products/get-accessories*')? 'active' : '' }}"
                                   href="{{url('/products/get-accessories/admin')}}">
                                    Accessories
                                </a>
                            </li>
                        </ul>
                    @endif
                @endif
                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-link-text {{ request()->is('products/get-mobile-phones*')? 'active' : '' }}"
                               href="{{url('/products/get-mobile-phones')}}">
                                Mobile Phones
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-link-text {{ request()->is('products/get-accessories*')? 'active' : '' }}"
                               href="{{url('/products/get-accessories')}}">
                                Accessories
                            </a>
                        </li>
                    </ul>
                @endguest
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->isRegisterUser())
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('sold-list/get-sold-list/user*')? 'active' : '' }}"
                                   href="{{url('/sold-list/get-sold-list/user')}}">
                                    History
                                </a>
                            </li>
                        </ul>
                    @endif
                @endif
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('users/get-user-list')? 'active' : '' }}"
                                   href="{{ url('/users/get-user-list') }}">
                                    Users List
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('sold-list/get-sold-list/admin*')? 'active' : '' }}"
                                   href="{{ url('/sold-list/get-sold-list/admin') }}">
                                    Sold Products
                                </a>
                            </li>
                        </ul>
                    @endif
                @endif
                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link nav-link-text {{ request()->is('info/get-contact-us')? 'active' : '' }}"
                               href="{{url('/info/get-contact-us')}}">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                @endguest
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->isRegisterUser())
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link nav-link-text {{ request()->is('info/get-contact-us')? 'active' : '' }}"
                                   href="{{url('/info/get-contact-us')}}">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                @endif
            @endif

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>



</body>
</html>
