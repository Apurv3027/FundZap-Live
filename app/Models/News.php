<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'image_url',
        'company_name',
        'news',
        'date',
        'url',
    ];
}
