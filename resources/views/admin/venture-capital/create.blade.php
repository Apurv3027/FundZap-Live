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
                                    <label class="col-md-3 col-form-label">Subtitle:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => 'Enter Subtitle']) !!}
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
                                    <label class="col-md-3 col-form-label">Founded Year:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('founded_year', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Founded Year',
                                            'min' => 1900,
                                            'max' => date('Y'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Team Members:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('team_member', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Number of Team Members',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Count:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('portfolio_count', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Portfolio Count',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Sector:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('portfolio_sector', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Portfolio Sector',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Location:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('portfolio_location', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Portfolio Location',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Unicorns:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('portfolio_unicorns', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Number of Portfolio Unicorns',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Deals in Last 12 Months:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('deals_12_month', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Number of Deals',
                                            'min' => 0,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::select(
                                            'status',
                                            [
                                                'VC' => 'VC',
                                                'AN' => 'AN',
                                                'SFO' => 'SFO',
                                                'PDF' => 'PDF',
                                                'SIF' => 'SIF',
                                            ],
                                            null,
                                            ['class' => 'form-control'],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Is Seed:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::select('is_seed', [1 => 'Yes', 0 => 'No'], null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="vc_image" accept="image/*" class="form-control"
                                            required>
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
