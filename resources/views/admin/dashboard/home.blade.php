@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            {{-- <!-- BEGIN PAGE HEADER-->
            <h1 class="page-title"> Dashboard
                <small>overview & stats</small>
            </h1>
            <!-- END PAGE HEADER--> --}}

            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <span class="active">Dashboard</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->

            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalUsers }} </div>
                            <div class="desc"> New Users </div>
                        </div>
                        <a class="more" href="{{ route('admin.users') }}"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalNews }} </div>
                            <div class="desc"> News </div>
                        </div>
                        <a class="more" href="{{ route('admin.news') }}"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-folder-open"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalPortfolio }} </div>
                            <div class="desc"> Portfolios </div>
                        </div>
                        <a class="more" href="#"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-rocket"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalStartup }} </div>
                            <div class="desc"> Startups </div>
                        </div>
                        <a class="more" href="{{ route('admin.startups') }}"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-building"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalVentureCapital }} </div>
                            <div class="desc"> Venture Capitals </div>
                        </div>
                        <a class="more" href="{{ route('admin.venture') }}"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{ $totalOrders }} </div>
                            <div class="desc"> Orders </div>
                        </div>
                        <a class="more" href="#"> View more
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS 1-->

            <!-- BEGIN CHARTS SECTION -->
            <div class="row">
                <div class="col-md-6">
                    <!-- BEGIN SAMPLE CHART PORTLET-->
                    <div class="portlet light bordered" style="height: 500px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-haze"></i>
                                <span class="caption-subject bold uppercase"> User Registration Overview</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="userRegistrationChart" style="height: 350px;"></div>
                        </div>
                    </div>
                    <!-- END SAMPLE CHART PORTLET-->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN SAMPLE CHART PORTLET-->
                    <div class="portlet light bordered" style="height: 500px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-pie-chart font-blue-haze"></i>
                                <span class="caption-subject bold uppercase"> Overview </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="overview_chart" style="height: 400px;"></div>
                        </div>
                    </div>
                    <!-- END SAMPLE CHART PORTLET-->
                </div>
            </div>
            <!-- END CHARTS SECTION -->
        </div>
    </div>
@endsection

@section('script')
    <!-- Morris.js -->
    <script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}"></script>

    <script>
        $(function() {
            // Initialize sales chart
            Morris.Area({
                element: 'userRegistrationChart',
                data: @json($userRegistrations),
                xkey: 'day',
                ykeys: ['count'],
                labels: ['Registrations'],
                xLabels: 'day',
                hideHover: 'auto',
                resize: true,
                lineColors: ['#36c6d3'],
                fillOpacity: 0.5,
                pointFillColors: ['#f39c12'],
                pointStrokeColors: ['#333'],
                lineWidth: 5,
                parseTime: false,
                smooth: true,
            });

            // Initialize user statistics chart
            Morris.Donut({
                element: 'overview_chart',
                data: [{
                        label: 'News',
                        value: {{ $totalNews }}
                    },
                    {
                        label: 'Portfolios',
                        value: {{ $totalPortfolio }}
                    }, {
                        label: 'Startups',
                        value: {{ $totalStartup }}
                    }, {
                        label: 'Venture Capitals',
                        value: {{ $totalVentureCapital }}
                    }
                ],
                colors: ['#1c8cba', '#2ecc71', '#f39c12', '#e74c3c'],
                resize: true
            });
        });
    </script>
@endsection
