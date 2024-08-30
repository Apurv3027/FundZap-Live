<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;
use App\Models\VentureCapital;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $fillable = [
        'venture_capital_id',
        'pf_startup_name',
        'pf_startup_image',
        'pf_startup_url',
    ];

    // A Portfolio belongs to a Venture Capital
    public function ventureCapital()
    {
        return $this->belongsTo(VentureCapital::class);
    }
}
