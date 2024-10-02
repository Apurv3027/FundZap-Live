@extends('layouts.master')

@section('title', 'Create Venture Capital')

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
                    <span class="active">Create Venture Capital</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Create Venture Capital</span>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @include('errormessage')

                        <div class="portlet-body form">
                            {!! Form::open([
                                'route' => 'admin.venture.store',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('vc_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Venture Capital Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Category:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('vc_category', null, ['class' => 'form-control', 'placeholder' => 'Enter Category']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('vc_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital Website URL:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::url('vc_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Venture Capital URL']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="vc_image" accept="image/*" class="form-control">
                                        @error('vc_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Submit</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
