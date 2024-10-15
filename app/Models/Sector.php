<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentureCapital;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';

    protected $fillable = ['venture_capital_id', 'name', 'value'];

    public function ventureCapital()
    {
        return $this->belongsTo(VentureCapital::class);
    }

}
