<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentureCapital;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = ['venture_capital_id', 'name', 'value'];

    public function ventureCapital()
    {
        return $this->belongsTo(VentureCapital::class);
    }
}
