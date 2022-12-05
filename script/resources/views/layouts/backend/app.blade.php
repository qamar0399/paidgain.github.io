<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@hasSection('title')@yield('title') | @endif {{ config('app.name') }}</title>

    <!-- Favicon icon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/selectric.css') }}">

    @yield('style')
    @stack('css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">

</head>

<body>

    <div id="app">
        <div class="main-wrapper">
        <!--- Header Section ---->
        @include('layouts.backend.partials.header')

        <!--- Sidebar Section --->
        @include('layouts.backend.partials.sidebar')

        <!--- Main Content --->
            <div class="main-content  main-wrapper-1">
                <section class="section">
                    @yield('head')
                </section>
                @yield('content')
            </div>

        @yield('modal')

        <!--- Footer Section --->
            {{-- @include('layouts.backend.partials.footer') --}}
        </div>
    </div>


    <input type="hidden" class="placeholder_image" value="{{ asset('admin/img/img/placeholder.png') }}">

    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="site_url" value="{{ url('/') }}">

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('admin/js/form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.selectric.min.js') }}"></script>
    @yield('script')
    @stack('script')
    <script src="{{ asset('admin/js/main.js') }}"></script>

    @if(session('success'))
        <script>
            "use strict";
            Sweet('success', '{{ session('success') }}')
        </script>
    @endif
</body>
</html>
