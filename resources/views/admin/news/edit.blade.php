@extends('layouts.master')

@section('title', 'Update News')

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
                    <span class="active">Update News</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Update News</span>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @include('errormessage')
                        <div class="portlet-body form">
                            {!! Form::model($news, [
                                'route' => ['admin.news.update', $news->id],
                                'method' => 'PUT',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Company Name:<span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">News:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('news', null, ['class' => 'form-control', 'placeholder' => 'Enter News']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Date:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::date('date', null, [
                                            'class' => 'form-control',
                                            'min' => '2000-01-01',
                                            'max' => \Carbon\Carbon::now()->format('Y-m-d'),
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">URL:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::url('url', null, ['class' => 'form-control', 'placeholder' => 'Enter URL']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="image_url" accept="image/*" class="form-control">

                                        <!-- Display the current image -->
                                        @if ($news->image_url)
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset($news->image_url) }}" alt="Current Image"
                                                    style="max-height: 200px;">
                                            </div>
                                        @endif

                                        @error('image')
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
