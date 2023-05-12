<!-- Top Nav -->
<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand">{{ trans('messages.lbl_school_progress_app') }}</a>
    @auth
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
    @endauth
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Language (語) -->
            <li class="nav-item dropdown">
                <a id="navbarLangDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('resources/assets/images/common/'.App::getLocale().'.png') }}">
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarLangDropdown">
                    @if(App::getLocale() == "jp")
                    <a class="dropdown-item" href="{{ route('language','en') }}">
                        <img class="mr-2" src="{{ asset('resources/assets/images/common/en.png') }}">English
                    </a>
                    @elseif(App::getLocale() == "en")
                    <a class="dropdown-item" href="{{ route('language','jp') }}">
                        <img class="mr-2" src="{{ asset('resources/assets/images/common/jp.png') }}">日本語
                    </a>
                    @endif
                </div>
            </li>
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ trans('messages.lbl_login') }}</a>
                </li>
                <!-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ trans('messages.lbl_register') }}</a>
                    </li>
                @endif -->
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">{{ trans('messages.lbl_profile') }}</a>
                        <a class="dropdown-item" href="{{ route('admin.resetpassword') }}">{{ trans('messages.lbl_reset_password') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ trans('messages.lbl_logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </ul>
</nav>