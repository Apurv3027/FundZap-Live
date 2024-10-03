@extends('layouts.master')

@section('title', 'View User Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}">Users</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View User Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">User Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">User Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $user->user_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Mobile Number:</label>
                                    <div class="col-md-6">
                                        @if ($user->mobile_number)
                                            <p class="form-control-static">{{ $user->mobile_number }}</p>
                                        @else
                                            <p class="form-control-static">-</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Profile:</label>
                                    <div class="col-md-6">
                                        @if ($user->profile)
                                            <img src="{{ asset($user->profile) }}" alt="User Profile Image"
                                                style="max-height: 200px;">
                                        @else
                                            <p>No profile image available.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{ route('admin.users') }}" class="btn grey-salsa btn-outline">Back to
                                            Users
                                            List</a>
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
