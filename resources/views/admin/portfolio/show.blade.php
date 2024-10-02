@extends('layouts.master')

@section('title', 'View Portfolio Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.portfolio') }}">Portfolios</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View Portfolio Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Portfolio Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital ID:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $portfolio->venture_capital_id }} -
                                            {{ $ventureCapitals->vc_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $portfolio->pf_startup_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup URL:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static"><a href="{{ $portfolio->pf_startup_url }}"
                                                target="_blank">{{ $portfolio->pf_startup_url }}</a></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Image:</label>
                                    <div class="col-md-6">
                                        @if ($portfolio->pf_startup_image)
                                            <img src="{{ asset($portfolio->pf_startup_image) }}" alt="Startup Image"
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
                                        <a href="{{ route('admin.portfolio') }}" class="btn grey-salsa btn-outline">Back to
                                            Portfolio List</a>
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
