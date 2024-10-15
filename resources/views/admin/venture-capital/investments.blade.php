@extends('layouts.master')

@section('title', 'Create Investment')

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
                    <span class="active">Create Investment</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Create Investment</span>
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
                                'route' => ['admin.venture.investments.store', $venture_capital_id],
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Stage:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('stage', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Investment Stage',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Number of Startups:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::number('no_startup', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Number of Startups',
                                            'min' => 0,
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                </div>

                                <input type="hidden" name="venture_capital_id" value="{{ $venture_capital_id }}">

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
