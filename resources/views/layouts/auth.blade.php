<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/css/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('assets/js/demo_configurator.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- /theme JS files -->

    @stack('styles')
</head>
<body>

    <!-- Main navbar -->
    <div class="navbar navbar-dark navbar-static py-2">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="/" class="d-inline-flex align-items-center">
                    <img src="{{ asset('assets/images/logo_icon.svg') }}" alt="">
                    <img src="{{ asset('assets/images/logo_text_light.svg') }}" class="d-none d-sm-inline-block h-16px ms-3" alt="">
                </a>
            </div>

            <div class="d-flex justify-content-end align-items-center ms-auto">
                <ul class="navbar-nav flex-row">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                            <div class="d-flex align-items-center mx-md-1">
                                <i class="ph-lifebuoy"></i>
                                <span class="d-none d-md-inline-block ms-2">Support</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                            <div class="d-flex align-items-center mx-md-1">
                                <i class="ph-user-circle-plus"></i>
                                <span class="d-none d-md-inline-block ms-2">Register</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                            <div class="d-flex align-items-center mx-md-1">
                                <i class="ph-user-circle"></i>
                                <span class="d-none d-md-inline-block ms-2">Login</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">
                    @yield('content')
                </div>
                <!-- /content area -->

                <!-- Footer -->
                <div class="navbar navbar-sm navbar-footer border-top">
                    <div class="container-fluid">
                        <span>&copy; {{ date('Y') }} Locations Manager</span>

                        <ul class="nav">
                            <li class="nav-item">
                                <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph-lifebuoy"></i>
                                        <span class="d-none d-md-inline-block ms-2">Support</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item ms-md-1">
                                <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded">
                                    <div class="d-flex align-items-center mx-md-1">
                                        <i class="ph-file-text"></i>
                                        <span class="d-none d-md-inline-block ms-2">Docs</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    @stack('scripts')
</body>
</html>
