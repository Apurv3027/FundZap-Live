@extends('layouts.master')
@section('title', 'Orders')
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
                    <span class="active">Orders</span>
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
                                <span class="caption-subject bold">Orders Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-responsive"
                                id="orders-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                        <th>Startup Name</th>
                                        <th>Amount</th>
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
            var table = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.orders') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'startup_name',
                        name: 'startup_name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
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

        // Verify Payment Status
        $(document).on('click', '.verify-payment-status', function() {
            const orderId = $(this).data('id');
            const userId = $(this).data('user-id');
            const button = $(this); // Save reference to the clicked button

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Verify Payment Status',
                text: "Select the payment status:",
                icon: 'warning',
                input: 'select',
                inputOptions: {
                    'Accept': 'Accept',
                    'Reject': 'Reject'
                },
                inputPlaceholder: 'Select payment status',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                preConfirm: (status) => {
                    if (!status) {
                        Swal.showValidationMessage('You need to select a payment status');
                    }
                    return status;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedStatus = result.value;

                    console.log('User ID:', userId);
                    console.log('Order ID:', orderId);
                    console.log('Selected Status:', selectedStatus);

                    $.ajax({
                        url: '/admin/orders/verify-payment-status/' + userId + '/' + orderId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            payment_status: selectedStatus,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                }).then(() => {
                                    location.reload(); // Refresh the page after success
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                });
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = 'Failed to verify payment status.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += ' ' + xhr.responseJSON.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                            });
                        },
                    });
                }
            });
        });
    </script>

@endsection
