<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ "SPA" }}</title>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('resources/assets/js/libs/jquery.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('resources/assets/css/styles.css') }}" rel="stylesheet">
</head>
<body @guest class="sb-nav-fixed sb-sidenav-toggled" @else class="sb-nav-fixed" @endguest>
        <!-- Side Nav Bar -->
        @include('layouts.nav')
</body>
<!-- Scripts -->
<script type="text/javascript" src="{{ asset('resources/assets/js/libs/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/assets/js/navmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/assets/js/all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/assets/js/common.js') }}"></script>
<!-- Hide Sidebar -->
@if(!Auth::check())
<style type="text/css">
.sb-sidenav-toggled #layoutSidenav #layoutSidenav_nav {display: none;}
.sb-sidenav-toggled #layoutSidenav #layoutSidenav_content:before {
  top: 0;left: 0;background: none;z-index: unset;
}
</style>
@endif
</html>