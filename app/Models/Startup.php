<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;

class Startup extends Model
{
    use HasFactory;

    protected $table = 'startups';

    protected $fillable = [
        'startup_image',
        'startup_name',
        'startup_valuation',
        'startup_equity',
        'startup_view_count',
    ];
}
