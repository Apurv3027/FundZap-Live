<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentureCapital;

class Investment extends Model
{
    use HasFactory;

    protected $table = 'investments';

    protected $fillable = ['venture_capital_id', 'stage', 'no_startup'];

    public function ventureCapital()
    {
        return $this->belongsTo(VentureCapital::class);
    }
}
