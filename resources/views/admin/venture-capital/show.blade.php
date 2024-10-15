@extends('layouts.master')

@section('title', 'View Venture Capital Details')

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
                    <span class="active">View Venture Capital Details</span>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red-sunglo bold uppercase">Venture Capital Details</span>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Image:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->vc_image)
                                            <img src="{{ asset($ventureCapital->vc_image) }}" alt="Venture Capital Image"
                                                style="max-height: 200px;">
                                        @else
                                            <p>No image available.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Venture Capital Name:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->vc_name }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Subtitle:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->subtitle }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Investment:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->investments->isNotEmpty())
                                            <ul class="investment-list">
                                                @foreach ($ventureCapital->investments as $investment)
                                                    <li>
                                                        <strong>Stage:</strong> {{ $investment->stage }} |
                                                        <strong>Number of Startups:</strong> {{ $investment->no_startup }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="form-control-static">No investments available.</p>
                                        @endif

                                        <a
                                            href="{{ route('admin.venture.investments.create', ['venture_capital_id' => $ventureCapital->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Investments <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Sector:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->sectors->isNotEmpty())
                                            <ul class="investment-list">
                                                @foreach ($ventureCapital->sectors as $sector)
                                                    <li>
                                                        <strong>Name:</strong> {{ $sector->name }} |
                                                        <strong>Value:</strong> {{ $sector->value }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="form-control-static">No sectors available.</p>
                                        @endif

                                        <a
                                            href="{{ route('admin.venture.sectors.create', ['venture_capital_id' => $ventureCapital->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Sectors <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Description:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->vc_description }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Team Members:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->team_member }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Founded Year:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->founded_year }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Count:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->portfolio_count }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Sector:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->portfolio_sector }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Location:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->portfolio_location }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio Unicorns:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->portfolio_unicorns }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Deals in Last 12 Months:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->deals_12_month }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Country:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->countries->isNotEmpty())
                                            <ul class="investment-list">
                                                @foreach ($ventureCapital->countries as $country)
                                                    <li>
                                                        <strong>Name:</strong> {{ $country->name }} -
                                                        <strong>Value:</strong> {{ $country->value }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="form-control-static">No countries available.</p>
                                        @endif

                                        <a
                                            href="{{ route('admin.venture.countries.create', ['venture_capital_id' => $ventureCapital->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Country <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Portfolio:</label>
                                    <div class="col-md-6">
                                        @if ($ventureCapital->portfolios->isEmpty())
                                            <p class="form-control-static">No portfolios available.</p>
                                        @else
                                            <ul class="list-unstyled">
                                                @foreach ($ventureCapital->portfolios as $portfolio)
                                                    <li>
                                                        <strong>{{ $portfolio->pf_startup_name }}</strong>
                                                        ({{ $portfolio->founded_year }})
                                                        <br>
                                                        <img src="{{ asset($portfolio->pf_startup_image) }}"
                                                            alt="Portfolio Image" style="max-height: 100px;" /><br>
                                                        Funding: {{ $portfolio->funding }} USD<br>
                                                        Location: {{ $portfolio->location }}<br>
                                                        Investor: {{ $portfolio->investor }}<br>
                                                        Stage: {{ $portfolio->stage }}<br>
                                                        <hr>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <a
                                            href="{{ route('admin.venture.portfolios.create', ['venture_capital_id' => $ventureCapital->id]) }}">
                                            <button id="add_products" class="btn sbold" style="color: #FB4600">
                                                Add Portfolio <i class="fa fa-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->status }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Is Seed:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{{ $ventureCapital->is_seed ? 'Yes' : 'No' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{ route('admin.venture') }}" class="btn grey-salsa btn-outline">Back to
                                            Venture Capitals List</a>
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
