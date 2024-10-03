<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        // Admin
        $admin = User::create([
            'user_name'         => config('const.admin.user_name'),
            'email'             => config('const.admin.email'),
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make(config('const.admin.password')),
            'mobile_number'     => "NULL",
            'profile'           => "NULL",
            'document_verified' => 1,
            'token'             => "NULL",
        ]);

        // Generate Token
        $token = $admin->createToken('authToken')->plainTextToken;
        $admin->token = $token; // Store the token in the remember_token field
        $admin->save();
    }
}
