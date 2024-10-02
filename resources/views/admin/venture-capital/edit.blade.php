@extends('layouts.master')

@section('title', 'Update Venture Capital')

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
                    <span class="active">Update Venture Capital</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Update Venture Capital</span>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @include('errormessage')
                        <div class="portlet-body form">
                            {!! Form::model($ventureCapital, [
                                'route' => ['admin.venture.update', $ventureCapital->id],
                                'method' => 'PUT',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('vc_name', null, ['class' => 'form-control', 'placeholder' => 'Venture Capital Name']) !!}
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
                                    <label class="col-md-3 col-form-label">URL:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::url('vc_url', null, ['class' => 'form-control', 'placeholder' => 'Enter URL']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        <input type="file" name="vc_image" accept="image/*" class="form-control">

                                        <!-- Display the current image -->
                                        @if ($ventureCapital->vc_image)
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset($ventureCapital->vc_image) }}" alt="Current Image"
                                                    style="max-height: 200px;">
                                            </div>
                                        @endif

                                        @error('vc_image')
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
