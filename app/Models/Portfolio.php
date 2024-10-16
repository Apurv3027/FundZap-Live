<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentureCapital;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'venture_capital_id',
        'pf_startup_image',
        'pf_startup_name',
        'subtitle',
        'pf_startup_url',
        'founded_year',
        'funding',
        'location',
        'investor',
        'stage',
    ];

    public function ventureCapital()
    {
        return $this->belongsTo(VentureCapital::class);
    }
}
