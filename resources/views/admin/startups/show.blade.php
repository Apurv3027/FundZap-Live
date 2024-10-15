@extends('layouts.master')

@section('title', 'View Startup Details')

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
                    <span class="active">View Startup Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Startup Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        @if ($startup->startup_image)
                                            <img src="{{ asset($startup->startup_image) }}" alt="Startup Image"
                                                style="max-height: 200px;">
                                        @else
                                            <p>No image available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Year:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->year }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->location }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Valuation:</label>
                                    <div class="col-md-6">
                                        @if ($startup->valuations->isNotEmpty())
                                            <ul>
                                                @foreach ($startup->valuations as $valuation)
                                                    <li>
                                                        {{ $valuation->year }}: {{ number_format($valuation->value, 2) }}
                                                        USD
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No valuations available.</p>
                                        @endif

                                        <a
                                            href="{{ route('admin.startups.valuations.create', ['startup_id' => $startup->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Valuation <i class="fa fa-plus"></i>
                                            </button>
                                        </a>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Funding:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->total_funding }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Latest Funding:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->latest_funding }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Latest Investor:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->latest_investor }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Investor:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->total_investor }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Funding Round:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->funding_round }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Post Money Valuation:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->post_money_valuation }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Employee:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->employee_count }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_description }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Valuation:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ number_format($startup->startup_valuation, 2) }}
                                            USD</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Startup Equity (%):</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->startup_equity }}%</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">URL:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static"><a href="{{ $startup->startup_url }}"
                                                target="_blank">{{ $startup->startup_url }}</a></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->email }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Phone Number:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->phone_number }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">First Covered:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->first_covered }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Funding Round:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $startup->funding_round }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Funding Rounds:</label>
                                    <div class="col-md-6">
                                        @if ($startup->fundingRounds->isEmpty())
                                            <p class="form-control-static">No funding rounds available.</p>
                                        @else
                                            <ul>
                                                @foreach ($startup->fundingRounds as $round)
                                                    <li>
                                                        <strong>Date:</strong> {{ $round->date }} <br>
                                                        <strong>Round Name:</strong> {{ $round->round_name }} <br>
                                                        <strong>Amount:</strong> {{ $round->amount }} USD
                                                        <br>
                                                        <strong>Investor:</strong> {{ $round->investor }}
                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <a
                                            href="{{ route('admin.startups.funding_rounds.create', ['startup_id' => $startup->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Funding Rounds <i class="fa fa-plus"></i>
                                            </button>
                                        </a>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Competitors:</label>
                                    <div class="col-md-6">
                                        @if ($startup->competitors->isEmpty())
                                            <p class="form-control-static">No competitors available.</p>
                                        @else
                                            <ul>
                                                @foreach ($startup->competitors as $competitor)
                                                    <li>
                                                        <strong>Name:</strong> {{ $competitor->name }} <br>
                                                        <strong>Founded Year:</strong> {{ $competitor->founded_year }} <br>
                                                        <strong>Subtitle:</strong> {{ $competitor->subtitle }} <br>
                                                        <strong>Funding:</strong> {{ $competitor->funding }} USD <br>
                                                        <strong>Location:</strong> {{ $competitor->location }} <br>
                                                        <strong>Investor:</strong> {{ $competitor->investor }} <br>
                                                        <strong>Stage:</strong> {{ $competitor->stage }} <br>
                                                        <strong>Description:</strong> {{ $competitor->description }} <br>

                                                        @if ($competitor->image_url)
                                                            <strong>Image:</strong> <br>
                                                            <img src="{{ asset($competitor->image_url) }}"
                                                                alt="{{ $competitor->name }}" style="max-height: 100px;">
                                                        @else
                                                            <strong>Image:</strong> No image available.
                                                        @endif

                                                    </li>
                                                    <hr>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <a
                                            href="{{ route('admin.startups.competitors.create', ['startup_id' => $startup->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Competitors <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{ route('admin.startups') }}" class="btn grey-salsa btn-outline">Back
                                            to
                                            Startup List</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
