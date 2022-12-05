<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    {!! JsonLdMulti::generate() !!}
    {!! SEO::generate(true) !!}

    <!-- Favicon -->
    <link rel="icon" href="{{ get_option('logo_setting', true)->favicon ?? null }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/style.css?v=1.0') }}">
    @yield('css')
    @stack('css')

</head>

<body class="main-version bg-img bg-overlay" style="background-image: url('{{ asset('frontend/img/bg-img/bg-body.png') }}');">




@include('layouts.frontend.partials.loginmodal')

@include('layouts.frontend.partials.header')

@if(!isset($withOutBreadcrumb))
    @include('layouts.frontend.partials.breadcrumb')
@endif

@yield('content')

@include('layouts.frontend.partials.footer')

<!-- **** All JS Files ***** -->
<script src="{{ asset('frontend/js/jquery.min.js?v=1') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/vivus.min.js') }}"></script>

<script src="{{ asset('frontend/js/counter-up.min.js?v=1') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/svg.animation.js') }}"></script>
<script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('frontend/js/main-menu.js') }}"></script>

@stack('js')

<!-- Active -->
<script src="{{ asset('frontend/js/default-assets/active.js?v=1') }}"></script>
<script src="{{ asset('admin/js/form.js') }}"></script>
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>

@if (request()->get('target_modal') == 'register')
    <script>
        "use strict";
        $('.sign-btn').trigger('click');
        $('#register-tab').trigger('click');
    </script>
@endif

</body>
</html>
