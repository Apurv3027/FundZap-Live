<?php
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta name="robots" content="noindex, nofollow">
    <title>@lang('messages.siteName') - @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('admin_assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('admin_assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <link href="{{ asset('admin_assets/layouts/layout4/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/layouts/layout4/css/themes/default.min.css') }}" rel="stylesheet" type="text/css"
        id="style_color" />
    <link href="{{ asset('admin_assets/layouts/layout4/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('admin_assets/developer/developer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/tost/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">


    <!-- END THEME LAYOUT STYLES -->
    @yield('css')
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ url('admin_assets/images/fundzap-logo.jpg') }}" alt="logo"
                        class="logo-default login-page-logo" style="height: 50px; width: 150px" />
                </a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN PAGE ACTIONS -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                <!-- BEGIN HEADER SEARCH BOX -->

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="separator hide"> </li>

                        <!-- END NOTIFICATION DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN INBOX DROPDOWN -->

                        <!-- END INBOX DROPDOWN -->
                        <li class="separator hide"> </li>
                        <!-- BEGIN TODO DROPDOWN -->

                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <span class="username username-hide-on-mobile">
                                    {{ Auth::user()->user_name ?? 'Guest' }} </span>
                                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                <img alt="" class="img-circle"
                                    src="{{ url('assets/layouts/layout4/img/avatar9.jpg') }}" /> </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="nav-item start {{ Route::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="fa fa-home"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.users') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}" class="nav-link nav-toggle">
                            <i class="fa fa-users"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.news') ? 'active' : '' }}">
                        <a href="{{ route('admin.news') }}" class="nav-link nav-toggle">
                            <i class="fa fa-newspaper-o"></i>
                            <span class="title">News</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.portfolio') ? 'active' : '' }}">
                        <a href="{{ route('admin.portfolio') }}" class="nav-link nav-toggle">
                            <i class="fa fa-folder-open"></i>
                            <span class="title">Portfolio</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.startups') ? 'active' : '' }}">
                        <a href="{{ route('admin.startups') }}" class="nav-link nav-toggle">
                            <i class="fa fa-rocket"></i>
                            <span class="title">Startups</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.venture') ? 'active' : '' }}">
                        <a href="{{ route('admin.venture') }}" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">Venture Capitals</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-cogs"></i>
                            <span class="title">Settings</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-wrench"></i>
                                    <span class="title">General Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        @yield('content')
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> {{ now()->year }} &copy; @lang('messages.footer')</div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN QUICK NAV -->

    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
        <script src="{{ url('admin_assets/global/plugins/respond.min.js') }}"></script>
        <script src="{{ url('admin_assets/global/plugins/excanvas.min.js') }}"></script>
        <script src="{{ url('admin_assets/global/plugins/ie8.fix.min.js') }}"></script>
        <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('admin_assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('admin_assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin_assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin_assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin_assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}"
        type="text/javascript"></script>


    <script src="{{ asset('admin_assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('admin_assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('admin_assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('admin_assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        window.baseUrl = "<?php echo URL::to('/'); ?>";
    </script>
    <script src="{{ asset('admin_assets/tost/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/developer/developer.js') }}" type="text/javascript"></script>


    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- For Manage Timezone Start-->

    <script src="{{ asset('admin_assets/developer/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/developer/moment-timezone.js') }}" type="text/javascript"></script>
    <script>
        var tz = moment.tz.guess();
        document.cookie = "headvalue=" + tz;
        $(document).ready(function() {
            $.ajax({
                url: baseUrl + '/settimezone',
                type: "POST",
                dataType: 'json',
                data: {
                    timezone: tz
                },
                success: function(data) {},
                error: function(data) {

                }
            });
        });
    </script>

    <!-- For Manage Timezone End-->

    @yield('script')
</body>

</html>
