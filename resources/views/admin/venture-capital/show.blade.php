@extends('layouts.master')

@section('title', 'View Venture Capital Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.venture') }}">Venture Capitals</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View Venture Capital Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Venture Capital Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->vc_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Category:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->vc_category }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->vc_description }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">URL:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static"><a href="{{ $ventureCapital->vc_url }}"
                                                target="_blank">{{ $ventureCapital->vc_url }}</a></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->vc_image)
                                            <img src="{{ asset($ventureCapital->vc_image) }}" alt="Venture Capital Image"
                                                style="max-height: 200px;">
                                        @else
                                            <p>No image available.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{ route('admin.venture') }}" class="btn grey-salsa btn-outline">Back to
                                            Venture Capitals List</a>
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
