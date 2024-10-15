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
                    <span class="active">Create Startup</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Create Startup</span>
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
                                'route' => 'admin.startups.store',
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
                                    <label class="col-md-3 col-form-label">Startup Description:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('startup_description', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Startup Description',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Year:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('year', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Founded Year',
                                            'min' => 1900,
                                            'max' => date('Y'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Location:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Funding (USD):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('total_funding', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Total Funding Amount',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Latest Funding (USD):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('latest_funding', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Latest Funding Amount',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Latest Investor:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('latest_investor', null, ['class' => 'form-control', 'placeholder' => 'Latest Investor Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Investors:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('total_investor', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Total Investors Count',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Funding Round:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('funding_round', null, ['class' => 'form-control', 'placeholder' => 'Funding Round']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Post-Money Valuation:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('post_money_valuation', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Post-Money Valuation',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Employee Count:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('employee_count', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Number of Employees',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Valuation (USD):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('startup_valuation', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Startup Valuation',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Equity (%):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('startup_equity', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Equity (%)',
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
                                    <label class="col-md-3 col-form-label">Email:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Phone Number:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Phone Number']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">First Covered:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::date('first_covered', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="startup_image" accept="image/*" class="form-control"
                                            required>
                                        @error('startup_image')
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
