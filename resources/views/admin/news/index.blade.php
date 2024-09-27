@extends('layouts.master')
@section('title', 'News')
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            {{-- <h1 class="page-title"> News Details
            </h1> --}}
            <!-- END PAGE HEADER-->

            <div class="container">
                <h1 class="page-title">News Details</h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>News</th>
                            <th>URL</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $new)
                            <tr>
                                <td>{{ $new->id }}</td>
                                <td>{{ $new->company_name }}</td>
                                {{-- <td>{{ Str::limit($new->news, 50) }}</td> --}}
                                <td style="white-space: normal; word-wrap: break-word;">
                                    {{ Str::limit($new->news, 50) }}
                                </td>
                                {{-- <td>
                                    <a href="{{ $new->url }}" target="_blank">{{ Str::limit($new->url, 30) }}</a>
                                </td> --}}
                                <td style="white-space: normal; word-wrap: break-word;">
                                    <a href="{{ $new->url }}" target="_blank">{{ Str::limit($new->url, 30) }}</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($new->date)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
