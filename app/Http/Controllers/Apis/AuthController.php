<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helper\Helper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{

    public function loginUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'login' => 'required', // This will be either email or username
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            // Determine if login is email or username
            $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

            // Attempt to log the user in
            $credentials = [
                $login_type => $request->input('login'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // $token = $user->createToken('authToken')->accessToken;

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $user,
                        'token' => $user->token,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid login credentials',
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function registerUser(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'user_name' => 'required|unique:users,user_name',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'mobile_number' => 'required|numeric',
                'profile_url' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 302);
            }

            if ($request->hasFile('profile_url')) {
                $image = $request->file('profile_url');

                // Store the image in the 'public/users' directory
                $path = $image->store('users', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_verified = "1";
            $user->mobile_number = $request->mobile_number;
            $user->profile_url = $imageUrl;
            $user->token = "";
            $user->save();

            // Generate Token
            $token = $user->createToken('authToken')->plainTextToken;
            $user->token = $token;
            $user->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'created successfully.',
                'data' => $user,
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ], 302);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image in the 'public/users' directory
            $path = $image->store('users', 'public');

            // App URL
            $appurl = 'https://tortoise-new-emu.ngrok-free.app';

            // Generate a full URL to the image
            $url = $appurl . Storage::url($path);

            // Return the full URL so it can be accessed via the API
            return response()->json(['profile_url' => url($url)], 200);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }
}
