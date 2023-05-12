<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SPA</title>
        <!-- Styles -->
        <script type="text/javascript" src="{{ asset('resources/assets/js/libs/jquery.js') }}"></script>
        <link href="{{ asset('resources/assets/css/styles.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.top-nav')
        <div class="d-flex justify-content-center py-3">
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="links">
                                @if (Route::has('login'))
                                @auth
                                    <a class="btn btn-outline-secondary p-2" href="{{ url('/home') }}">{{ trans('messages.lbl_home') }}</a>
                                @else
                                    <a class="btn btn-outline-primary p-2" href="{{ route('login') }}">{{ trans('messages.lbl_teacher') }}</a>
                                    <a class="btn btn-outline-secondary p-2" href="{{ route('login') }}" href="#">{{ trans('messages.lbl_student') }}</a>
                                    <!-- @if (Route::has('register'))
                                        <a href="{{ route('register') }}">{{ trans('messages.lbl_register') }}</a>
                                    @endif -->
                                @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ trans('messages.lbl_register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> -->
    </body>
</html>
<script type="text/javascript" src="{{ asset('resources/assets/js/libs/bootstrap.bundle.min.js') }}"></script>
