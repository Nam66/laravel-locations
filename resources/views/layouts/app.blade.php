<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel')) - {{ config('app.name') }}</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/css/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">

    <!-- jQuery (must be loaded first) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Core JS files -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- DataTables -->
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <!-- /DataTables -->

    <!-- Select2 -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- /Select2 -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- /theme JS files -->

    @stack('styles')
</head>
<body>

    <!-- Main navbar -->
    <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
        <div class="container-fluid">
            <div class="d-flex d-lg-none me-2">
                <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                    <i class="ph-list"></i>
                </button>
            </div>

            <div class="navbar-brand flex-1 flex-lg-0">
                <a href="{{ route('index') }}" class="d-inline-flex align-items-center">
                    <img src="{{ asset('assets/images/logo_icon.svg') }}" alt="">
                    <img src="{{ asset('assets/images/logo_text_light.svg') }}" class="d-none d-sm-inline-block h-16px ms-3" alt="">
                </a>
            </div>

            <ul class="nav flex-row justify-content-end order-1 order-lg-2">
                <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                    <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                        <div class="status-indicator-container">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/demo/users/face11.jpg') }}" class="w-32px h-32px rounded-pill" alt="">
                            <span class="status-indicator bg-success"></span>
                        </div>
                        <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name ?? 'User' }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="ph-user-circle me-2"></i>
                            My profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="ph-gear me-2"></i>
                            Account settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ph-sign-out me-2"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Sidebar header -->
                <div class="sidebar-section">
                    <div class="sidebar-section-body d-flex justify-content-center">
                        <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                        <div>
                            <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                                <i class="ph-arrows-left-right"></i>
                            </button>

                            <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                                <i class="ph-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /sidebar header -->

                <!-- Main navigation -->
                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <li class="nav-item-header pt-0">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
                                <i class="ph-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item nav-item-submenu {{ request()->routeIs('locations.*') ? 'nav-item-expanded nav-item-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#locations-menu" aria-expanded="{{ request()->routeIs('locations.*') ? 'true' : 'false' }}">
                                <i class="ph-map-pin"></i>
                                <span>Locations</span>
                            </a>
                            <ul id="locations-menu" class="nav-group-sub collapse {{ request()->routeIs('locations.*') ? 'show' : '' }}">
                                <li class="nav-item"><a href="{{ route('locations.index') }}" class="nav-link {{ request()->routeIs('locations.index') ? 'active' : '' }}">All Locations</a></li>
                                <li class="nav-item"><a href="{{ route('locations.create') }}" class="nav-link {{ request()->routeIs('locations.create') ? 'active' : '' }}">Add Location</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->
                <div class="page-header page-header-light shadow">
                    <div class="page-header-content d-lg-flex">
                        <div class="d-flex">
                            <h4 class="page-title mb-0">
                                @yield('page-title', 'Dashboard')
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success alert-styled-left alert-dismissible fade show" role="alert">
                            <span class="fw-semibold">{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-styled-left alert-dismissible fade show" role="alert">
                            <span class="fw-semibold">{{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
                <!-- /content area -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    @stack('scripts')
</body>
</html>
