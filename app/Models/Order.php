<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'status',
        'startup_name',
        'startup_equity',
        'startup_valuation',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
