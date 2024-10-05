@extends('layouts.master')
@section('title', 'News')
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
                    <span class="active">News</span>
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
                                <span class="caption-subject bold">News Details</span>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="{{ route('admin.news.create') }}">
                                    <button id="add_products" class="btn sbold" style="color: #FB4600">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-responsive" id="news-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>News</th>
                                        <th>URL</th>
                                        <th>Date</th>
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
            var table = $('#news-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.news') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'news',
                        name: 'news'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        width: '75px'
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

        window.history.replaceState({}, document.title, baseUrl + "/admin/news");

        $(document).on('click', '.deleterecord', function() {
            var newsId = $(this).attr('id');
            var button = $(this);
            console.log('Deleting news with ID: ', newsId); // Debug

            $.ajax({
                url: '/admin/news/' + newsId + '/delete',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}', // Ensure the CSRF token is passed
                    id: newsId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        alert('Failed to delete news.');
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                    });
                }
            });
        });
    </script>

@endsection
