@extends('layouts.master')

@section('title', 'View Startup Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.startups') }}">Startups</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View Startup Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Startup Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_description }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Valuation:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ number_format($startup->startup_valuation, 2) }}
                                            USD</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Equity (%):</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_equity }}%</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">View Count:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_view_count }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Website:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static"><a href="{{ $startup->startup_url }}"
                                                target="_blank">{{ $startup->startup_url }}</a></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        @if ($startup->startup_image)
                                            <img src="{{ asset($startup->startup_image) }}" alt="Startup Image"
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
                                        <a href="{{ route('admin.startups') }}" class="btn grey-salsa btn-outline">Back to
                                            Startup List</a>
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
