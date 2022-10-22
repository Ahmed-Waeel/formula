<!doctype html>
@php
$lang = LaravelLocalization::getCurrentLocale();
$dir = ($lang == 'ar' ? 'rtl' : 'ltr')
@endphp
<html lang="{{ $lang }}" dir="{{ $dir }}">

<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('tabTitle', __('view.companyName')) </title>
    <!-- CSS files -->
    @if($lang == 'en')
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-flags.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-payments.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-vendors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.min.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/tabler.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-flags.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-payments.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler-vendors.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.rtl.min.css') }}" rel="stylesheet">
    @endif

    <!-- Jquery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
    <div class="wrapper">
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a>
                        <img src="{{ asset('static/logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    @php $setLang = ($lang == 'en' ? 'ar' : 'en' ) @endphp
                    <a href="{{ LaravelLocalization::getLocalizedURL($setLang, null, [], true) }}" class="nav-link px-0">
                        @if($lang == 'en') العربية @else English @endif
                    </a>
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="{{ __('view.enableDarkMode') }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                        <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="{{ __('view.enableLightMode') }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brightness-up -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="12" cy="12" r="3" />
                            <line x1="12" y1="5" x2="12" y2="3" />
                            <line x1="17" y1="7" x2="18.4" y2="5.6" />
                            <line x1="19" y1="12" x2="21" y2="12" />
                            <line x1="17" y1="17" x2="18.4" y2="18.4" />
                            <line x1="12" y1="19" x2="12" y2="21" />
                            <line x1="7" y1="17" x2="5.6" y2="18.4" />
                            <line x1="6" y1="12" x2="4" y2="12" />
                            <line x1="7" y1="7" x2="5.6" y2="5.6" />
                        </svg>
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url( {{ (Auth::user()->photo != '' ? asset('uploads/admins') . '/' . Auth::user()->photo : asset('static/avatars/000m.jpg')) }})"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('admin.edit') }}" class="dropdown-item">{{ __('view.profile') }}</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item">{{ __('view.logout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item" customers_tab>
                                <a class="nav-link" href="{{ route('customer.showAll') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                <polyline points="5 12 3 12 12 3 21 12 19 12">
                                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7">
                                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6">
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __('view.customers') }}
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item" hotels_tab>
                                <a class="nav-link" href="{{ route('hotel.showAll') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                <polyline points="5 12 3 12 12 3 21 12 19 12">
                                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7">
                                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6">
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __('view.hotelsAndRooms') }}
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item" flights_tab>
                                <a class="nav-link" href="{{ route('flight.showAll') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plane -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                <path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z">
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __('view.flights') }}
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item" reservations_tab>
                                <a class="nav-link" href="{{ route('reservation.showAll') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/notes -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                <rect x="5" y="3" width="14" height="18" rx="2">
                                                    <line x1="9" y1="7" x2="15" y2="7">
                                                        <line x1="9" y1="11" x2="15" y2="11">
                                                            <line x1="9" y1="15" x2="13" y2="15">
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __('view.reservations') }}
                                    </span>
                                </a>
                            </li>
                            @if(Auth::user()->role)
                            <li class="nav-item" admins_tab>
                                <a class="nav-link" href="{{ route('admin.showAll') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/notes -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                <rect x="5" y="3" width="14" height="18" rx="2">
                                                    <line x1="9" y1="7" x2="15" y2="7">
                                                        <line x1="9" y1="11" x2="15" y2="11">
                                                            <line x1="9" y1="15" x2="13" y2="15">
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        {{ __('view.admins') }}
                                    </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    @if(Session::has('success'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="col-sm-12">
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    {{ __('view.madeBy') }} <a href="https://www.linkedin.com/in/ahmeed-waael/" target="_blank">{{ __('view.developerName') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    {{ __('view.copyRights', ['year' => date("Y"), 'company' => __('view.companyName')]) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{ asset('js/demo.min.js') }}"></script>

    <script>
        const theme = ($('body').hasClass('theme-light') ? "?theme=light" : "?theme=dark");
        window.history.replaceState(null, null, theme);
    </script>
</body>

</html>