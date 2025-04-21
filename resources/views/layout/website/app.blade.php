<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="surfside media" />
    <link rel="shortcut icon" href="{{ asset('website/images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('website/css/custom.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>


<body class="gradient-bg">
    @extends('layout.toaster')
    <main>
        @include('layout.website.header')
        @yield('website')
    </main>
    <hr class="mt-5 text-secondary" />
    @include('layout.website.footer')

    <script src="{{ asset('website/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('website/js/theme.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>
