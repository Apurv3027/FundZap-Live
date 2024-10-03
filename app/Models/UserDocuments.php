<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\helper;
use App\Models\User;

class UserDocuments extends Model
{
    use HasFactory;

    protected $table = 'user_documents';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'city',
        'selfie_photo',
        'aadhar_front_image',
        'aadhar_back_image',
        'pan_card_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
