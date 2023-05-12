<!-- Top Nav Bar -->
@include('layouts.top-nav')
<!-- SideBar&MainContent -->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @if(null !== (session()->get('userRole')) && session()->get('userRole') == '1')
        <!-- Admin  Layout -->
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">{{ trans('messages.lbl_core') }}</div>
                    <a class="nav-link" href="{{ route('home') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        {{ trans('messages.lbl_dashboard') }}
                    </a>
                    <div class="sb-sidenav-menu-heading">{{ trans('messages.lbl_interface') }}</div>
                    <!-- 授業 -->
                    <a class="nav-link collapsed" href="{{ route('classes.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chalkboard"></i></div>
                        {{ trans('messages.lbl_classes') }}
                    </a>
                    <!-- 科目 -->
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjectLayouts" aria-expanded="false" aria-controls="collapseSubjectLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        {{ trans('messages.lbl_subjects') }}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseSubjectLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('subjects.list') }}">
                                <i class="fa fa-list mr-1" aria-hidden="true"></i>{{ trans('messages.lbl_list') }}
                            </a>
                            <a class="nav-link" href="{{ route('subjects.subjectrelationlist') }}">
                                <i class="fas fa-chalkboard-teacher mr-1" aria-hidden="true"></i>
                                {{ trans('messages.lbl_subject_class_list') }}
                            </a>
                        </nav>
                    </div>
                    <!-- 学生 -->
                    <a class="nav-link collapsed" href="{{ route('students.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                        {{ trans('messages.lbl_students') }}
                    </a>
                    <!-- 結果 -->
                    <a class="nav-link collapsed" href="{{ route('result.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        {{ trans('messages.lbl_result') }}
                    </a>
                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                <div class="small"></div>
            </div> -->
        </nav>
        @elseif(null !== (session()->get('userRole')) && session()->get('userRole') == '0')
        <!-- User  Layout -->
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">{{ trans('messages.lbl_core') }}</div>
                    <a class="nav-link" href="{{ route('home') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        {{ trans('messages.lbl_dashboard') }}
                    </a>
                    <div class="sb-sidenav-menu-heading">{{ trans('messages.lbl_interface') }}</div>
                    <!-- 授業 -->
                    <a class="nav-link collapsed" href="{{ route('classes.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chalkboard"></i></div>
                        {{ trans('messages.lbl_classes') }}
                    </a>
                    <!-- 科目 -->
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubjectLayouts" aria-expanded="false" aria-controls="collapseSubjectLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        {{ trans('messages.lbl_subjects') }}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseSubjectLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('subjects.list') }}">
                                <i class="fa fa-list mr-1" aria-hidden="true"></i>{{ trans('messages.lbl_list') }}
                            </a>
                            <a class="nav-link" href="{{ route('subjects.subjectrelationlist') }}">
                                <i class="fas fa-chalkboard-teacher mr-1" aria-hidden="true"></i>
                                {{ trans('messages.lbl_subject_class_list') }}
                            </a>
                        </nav>
                    </div>
                    <!-- 学生 -->
                    <a class="nav-link collapsed" href="{{ route('students.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                        {{ trans('messages.lbl_practice') }}
                    </a>
                    <!-- 結果 -->
                    <a class="nav-link collapsed" href="{{ route('result.list') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        {{ trans('messages.lbl_result') }}
                    </a>
                </div>
            </div>
            <!-- <div class="sb-sidenav-footer">
                <div class="small"></div>
            </div> -->
        </nav>
        @endif
    </div>
    <div id="layoutSidenav_content">
        <main class="py-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    @include('partials.flash-message')
                    
                    @yield('content')
                    </div>
                </div>
            </div>
        </main>
        <!-- <footer class="py-1 bg-dark mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; SPA 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer> -->
    </div>
</div>