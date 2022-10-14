<!doctype html>
@php
$lang = LaravelLocalization::getCurrentLocale();
$dir = ($lang == 'ar' ? 'rtl' : 'ltr')
@endphp
<html lang="{{ $lang }}" dir="{{ $dir }}">

<head>
    <meta charset="utf-8">
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

<body class="border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a class="navbar-brand navbar-brand-autodark"><img src="{{ asset('static/logo.svg') }}" height="36" alt=""></a>
            </div>
            @yield('content')
        </div>
    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{ asset('js/demo.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('a[password]').on('click', function() {
                let type = ($('[password-input]').attr('type') == 'password' ? 'text' : 'password');
                $('[password-input]').attr('type', type);
            });
        });
    </script>
</body>

</html>