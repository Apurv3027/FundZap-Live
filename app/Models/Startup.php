<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;
use App\Models\Valuation;
use App\Models\FundingRound;
use App\Models\Competitor;

class Startup extends Model
{
    use HasFactory;

    protected $table = 'startups';

    protected $fillable = [
        'startup_image',
        'startup_name',
        'year',
        'location',
        'total_funding',
        'latest_funding',
        'latest_investor',
        'total_investor',
        'funding_round',
        'post_money_valuation',
        'employee_count',
        'startup_description',
        'startup_valuation',
        'startup_equity',
        'startup_view_count',
        'startup_url',
        'email',
        'phone_number',
        'first_covered',
    ];

    public function valuations()
    {
        return $this->hasMany(Valuation::class);
    }

    public function fundingRounds()
    {
        return $this->hasMany(FundingRound::class);
    }

    public function competitors()
    {
        return $this->hasMany(Competitor::class);
    }
}
