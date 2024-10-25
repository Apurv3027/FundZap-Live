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

                                <!-- Existing user details -->
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

                                <!-- Display Profile Image -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Profile:</label>
                                    <div class="col-md-6">
                                        @if ($user->profile)
                                            <img src="{{ asset($user->profile) }}" alt="User Profile Image"
                                                style="max-height: 150px;">
                                        @else
                                            <img src="{{ url('assets/layouts/layout4/img/avatar9.jpg') }}"
                                                alt="User Profile Image" style="max-height: 150px;">
                                            <p>No profile image available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">User Documents</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-body">

                                @if ($userDocuments->isNotEmpty())
                                    @foreach ($userDocuments as $document)
                                        @if ($user->document_verified)
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">First Name:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->first_name }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Last Name:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->last_name }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Phone Number:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->phone_number }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Pin Code:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->pin_code }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">City:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->city }}</p>
                                                </div>
                                            </div>

                                            <!-- Display Selfie Photo -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Selfie Photo:</label>
                                                <div class="col-md-6">
                                                    @if ($document->selfie_photo)
                                                        <img src="{{ asset($document->selfie_photo) }}" alt="Selfie Photo"
                                                            style="max-height: 150px;">
                                                    @else
                                                        <p>No selfie photo available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display Aadhar Front Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Aadhar Front:</label>
                                                <div class="col-md-6">
                                                    @if ($document->aadhar_front_image)
                                                        <img src="{{ asset($document->aadhar_front_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No aadhar front image available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display Aadhar Back Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Aadhar Back:</label>
                                                <div class="col-md-6">
                                                    @if ($document->aadhar_back_image)
                                                        <img src="{{ asset($document->aadhar_back_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No aadhar back image available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display PAN Card Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">PAN Card Image:</label>
                                                <div class="col-md-6">
                                                    @if ($document->pan_card_image)
                                                        <img src="{{ asset($document->pan_card_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No pan card image available.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning" role="alert">
                                                User's documents are not verified.
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">First Name:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->first_name }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Last Name:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->last_name }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Phone Number:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->phone_number }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Pin Code:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->pin_code }}</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">City:</label>
                                                <div class="col-md-6">
                                                    <p class="form-control-static">{{ $document->city }}</p>
                                                </div>
                                            </div>

                                            <!-- Display Selfie Photo -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Selfie Photo:</label>
                                                <div class="col-md-6">
                                                    @if ($document->selfie_photo)
                                                        <img src="{{ asset($document->selfie_photo) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No selfie photo available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display Aadhar Front Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Aadhar Front:</label>
                                                <div class="col-md-6">
                                                    @if ($document->aadhar_front_image)
                                                        <img src="{{ asset($document->aadhar_front_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No aadhar front image available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display Aadhar Back Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Aadhar Back:</label>
                                                <div class="col-md-6">
                                                    @if ($document->aadhar_back_image)
                                                        <img src="{{ asset($document->aadhar_back_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No aadhar back image available.</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Display PAN Card Image -->
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">PAN Card Image:</label>
                                                <div class="col-md-6">
                                                    @if ($document->pan_card_image)
                                                        <img src="{{ asset($document->pan_card_image) }}"
                                                            alt="Selfie Photo" style="max-height: 150px;">
                                                    @else
                                                        <p>No pan card image available.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p>No documents available for this user.</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="{{ route('admin.users') }}" class="btn grey-salsa btn-outline">Back to
                                        Users List</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endsection
