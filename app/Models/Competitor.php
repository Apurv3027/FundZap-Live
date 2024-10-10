<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Startup;

class Competitor extends Model
{
    use HasFactory;

    protected $table = 'competitors';

    protected $fillable = [
        'startup_id',
        'image_url',
        'name',
        'subtitle',
        'founded_year',
        'funding',
        'location',
        'investor',
        'stage',
        'description',
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
