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
            'first_name'        => config('const.admin.first_name'),
            'last_name'         => config('const.admin.last_name'),
            'user_name'         => config('const.admin.user_name'),
            'email'             => config('const.admin.email'),
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make(config('const.admin.password')),
            'is_verified'       => config('const.admin.is_verified'),
            'mobile_number'     => config('const.admin.mobile_number'),
            'profile_url'       => config('const.admin.profile_url'),
            'token'             => "NULL",
        ]);

        // Generate Token
        $token = $admin->createToken('authToken')->plainTextToken;
        $admin->token = $token; // Store the token in the remember_token field
        $admin->save();
    }
}
