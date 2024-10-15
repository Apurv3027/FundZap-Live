@extends('layouts.master')

@section('title', 'Create Startup')

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
                    <span class="active">Create Competitors</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Create Competitors</span>
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
                                'route' => ['admin.startups.competitors.store', $startup_id],
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Competitor Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Competitor Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Subtitle:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => 'Subtitle']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Founded Year:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('founded_year', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Founded Year',
                                            'min' => 1900,
                                            'max' => date('Y'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Funding (USD):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('funding', null, ['class' => 'form-control', 'placeholder' => 'Funding Amount', 'min' => 0]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Location:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Investor:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('investor', null, ['class' => 'form-control', 'placeholder' => 'Investor Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Stage:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('stage', null, ['class' => 'form-control', 'placeholder' => 'Stage']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="image_url" accept="image/*" class="form-control"
                                            required>
                                        @error('image_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="startup_id" value="{{ $startup_id }}">

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
