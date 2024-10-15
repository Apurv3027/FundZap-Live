@extends('layouts.master')

@section('title', 'Create Funding Round')

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
                    <span class="active">Create Funding Round</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Create Funding Round</span>
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
                                'route' => ['admin.startups.funding_rounds.store', $startup_id],
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Date:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::date('date', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Date',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Round Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('round_name', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Round Name',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Amount (USD):<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('amount', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Amount',
                                            'min' => 0,
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Investor:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('investor', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Investor Name',
                                            'required' => true,
                                        ]) !!}
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
