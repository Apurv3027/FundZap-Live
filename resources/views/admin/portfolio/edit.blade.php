@extends('layouts.master')

@section('title', 'Update Portfolio')

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
                    <span class="active">Update Portfolio</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Update Portfolio</span>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @include('errormessage')

                        <div class="portlet-body form">
                            {!! Form::model($portfolio, [
                                'route' => ['admin.portfolio.update', $portfolio->id],
                                'method' => 'PUT',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}

                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::select(
                                            'venture_capital_id',
                                            $ventureCapitals->mapWithKeys(function ($vc) {
                                                return [$vc->id => $vc->id . ' - ' . $vc->vc_name];
                                            }),
                                            null,
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'Select Venture Capital',
                                            ],
                                        ) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('pf_startup_name', null, ['class' => 'form-control', 'placeholder' => 'Startup Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup URL:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::url('pf_startup_url', null, ['class' => 'form-control', 'placeholder' => 'Enter Startup URL']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Image:</label>
                                    <div class="col-md-6">
                                        <input type="file" name="pf_startup_image" accept="image/*" class="form-control">

                                        <!-- Display the current image -->
                                        @if ($portfolio->pf_startup_image)
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset($portfolio->pf_startup_image) }}" alt="Current Image"
                                                    style="max-height: 200px;">
                                            </div>
                                        @endif

                                        @error('pf_startup_image')
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
