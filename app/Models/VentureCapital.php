<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;
use App\Models\Portfolio;

class VentureCapital extends Model
{
    use HasFactory;

    protected $table = 'venture_capitals';

    protected $fillable = [
        'vc_name',
        'vc_category',
        'vc_image',
        'vc_description',
    ];

    // A Venture Capital can have many portfolios
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
