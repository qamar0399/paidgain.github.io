<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>@hasSection('title')
            @yield('title') -
        @endif{{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    @stack('css')
</head>

<body>



<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="ecaps-page-wrapper">
    <!-- Sidemenu Area -->
    <div class="ecaps-sidemenu-area">
        <!-- Desktop Logo -->
        <div class="ecaps-logo">
            <a href="{{ route('user.dashboard') }}">
                <img class="desktop-logo" src="{{ asset(get_option('logo_setting', true)->logo ?? null) }}" alt="Logo">
                <img class="small-logo" src="{{ asset(get_option('logo_setting', true)->favicon ?? null) }}" alt="Logo">
            </a>
        </div>
        <!-- Side Nav -->
        @include('layouts.user.partials.sidebar')
    </div>

    <!-- Page Content -->
    <div class="ecaps-page-content">
        <!-- Top Header Area -->
        @include('layouts.user.partials.navbar')
        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Contact area Start -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- Footer Area -->
            @include('layouts.user.partials.footer')
        </div>
    </div>
</div>

@yield('extra')
<!-- ======================================
    ********* Page Wrapper Area End ***********
======================================= -->

<!-- Must needed plugins to the run this Template -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/dashboard/js/ecaps.bundle.js') }}"></script>

<!-- Active JS -->
<script src="{{ asset('frontend/dashboard/js/default-assets/active.js') }}"></script>
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin/js/form.js') }}"></script>
@stack('js')

</body>
</html>
