@extends('layouts.master')
@section('title', 'Users')
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
                    <span class="active">Users</span>
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
                                <span class="caption-subject bold">Users Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-responsive" id="users-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th width="180">Action</th>
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
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'users.document_verified'
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

        // Verify User Documents
        $(document).on('click', '.verify-documents', function() {
            var userId = $(this).attr('user_id');
            var button = $(this);

            $.ajax({
                url: '/admin/users/' + userId + '/verify-documents',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            // Refresh the page after the success message is acknowledged
                            location.reload();
                        });

                        button.replaceWith(
                            '<button type="button" class="class="btn green btn-xs">Verified</button>'
                        );
                    } else {
                        alert('Failed to verify documents.');
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                        // Error message (No documents found)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message,
                        });
                    } else {
                        // Generic error handling
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.',
                        });
                    }
                },
            });
        });

        // Delete User Data
        $(document).on('click', '.deleterecord', function() {
            var userId = $(this).attr('id');
            var button = $(this);

            // Show confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will permanently delete the user and their documents!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, make the AJAX DELETE request
                    $.ajax({
                        url: '/admin/users/' + userId + '/delete',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // Ensure the CSRF token is passed
                            user_id: userId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                }).then(() => {
                                    location.reload(); // Refresh the page after success
                                });
                            } else {
                                alert('Failed to delete user.');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON.message,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong. Please try again.',
                                });
                            }
                        },
                    });
                }
            });
        });
    </script>

@endsection
