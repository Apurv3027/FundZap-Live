<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Startup;

class Valuation extends Model
{
    use HasFactory;

    protected $table = 'valuations';

    protected $fillable = [
        'startup_id',
        'year',
        'value',
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
