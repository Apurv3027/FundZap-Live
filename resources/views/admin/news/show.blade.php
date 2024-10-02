@extends('layouts.master')

@section('title', 'View News Details')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.news') }}">News</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">View News Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">News Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Company Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $news->company_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">News:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $news->news }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Date:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">
                                            {{ \Carbon\Carbon::parse($news->date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">URL:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static"><a href="{{ $news->url }}"
                                                target="_blank">{{ $news->url }}</a></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        @if ($news->image_url)
                                            <img src="{{ asset($news->image_url) }}" alt="News Image"
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
                                        <a href="{{ route('admin.news') }}" class="btn grey-salsa btn-outline">Back to News
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
