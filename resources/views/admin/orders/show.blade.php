@extends('layouts.master')

@section('title', 'View Order Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}">Order</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View Order Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Order Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                @if ($order)
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Name:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->name }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->email }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Phone:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->phone }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Status:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->status }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Startup Name:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->startup_name }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Startup Equity (%):</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ $order->startup_equity }}%</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Startup Valuation:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ number_format($order->startup_valuation, 2) }}
                                                USD</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Amount:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{ number_format($order->amount, 2) }}
                                                USD</p>
                                        </div>
                                    </div>
                                @else
                                    <p>Order not found.</p>
                                @endif

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{ route('admin.orders') }}" class="btn grey-salsa btn-outline">Back to
                                            Orders List</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
