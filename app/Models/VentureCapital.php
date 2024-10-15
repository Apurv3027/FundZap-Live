<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;
use App\Models\Investment;
use App\Models\Sector;
use App\Models\Country;
use App\Models\Portfolio;

class VentureCapital extends Model
{
    use HasFactory;

    protected $table = 'venture_capitals';

    protected $fillable = [
        'vc_image',
        'vc_name',
        'subtitle',
        'vc_description',
        'vc_category',
        'vc_url',
        'team_member',
        'founded_year',
        'portfolio_count',
        'portfolio_sector',
        'portfolio_location',
        'portfolio_unicorns',
        'deals_12_month',
        'status',
        'is_seed',
    ];

    protected $casts = [
        'is_seed' => 'boolean',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
