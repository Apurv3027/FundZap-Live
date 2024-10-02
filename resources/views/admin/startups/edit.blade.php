@extends('layouts.master')

@section('title', 'Update Startup')

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
                    <span class="active">Update Startup</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Update Startup</span>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @include('errormessage')
                        <div class="portlet-body form">
                            {!! Form::model($startup, [
                                'route' => ['admin.startups.update', $startup->id],
                                'method' => 'PUT',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('startup_name', null, ['class' => 'form-control', 'placeholder' => 'Startup Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('startup_description', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Description',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Valuation:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('startup_valuation', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Startup Valuation',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Equity:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('startup_equity', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Equity (%)',
                                            'min' => 0,
                                            'max' => 100,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup URL:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::url('startup_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Startup URL']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="startup_image" accept="image/*" class="form-control">

                                        <!-- Display the current image -->
                                        @if ($startup->startup_image)
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset($startup->startup_image) }}" alt="Current Image"
                                                    style="max-height: 200px;">
                                            </div>
                                        @endif

                                        @error('startup_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Update</button>
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
