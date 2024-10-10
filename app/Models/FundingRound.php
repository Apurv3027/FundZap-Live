<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Startup;

class FundingRound extends Model
{
    use HasFactory;

    protected $table = 'funding_rounds';

    protected $fillable = [
        'startup_id',
        'date',
        'round_name',
        'amount',
        'investor',
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
