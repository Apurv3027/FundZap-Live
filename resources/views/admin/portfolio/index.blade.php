@extends('layouts.master')
@section('title', 'Portfolio')
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Portfolio</span>
                </li>
            </ul>
            <!-- END PAGE HEADER-->

            <!-- BEGIN DASHBOARD STATS 1-->
            @include('errormessage')
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <span class="caption-subject bold">Portfolio Details</span>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="#">
                                    <button id="add_products" class="btn sbold" style="color: #FB4600">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-responsive"
                                id="portfolio-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Venture Capital Name</th>
                                        <th>Startup Name</th>
                                        <th>Startup URL</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS 1-->
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $(function() {
            var table = $('#portfolio-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.portfolio') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'venture_capital_id',
                        name: 'venture_capital_id'
                    },
                    {
                        data: 'pf_startup_name',
                        name: 'pf_startup_name'
                    },
                    {
                        data: 'pf_startup_url',
                        name: 'pf_startup_url'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

@endsection
