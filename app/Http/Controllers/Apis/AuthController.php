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
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

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
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $validator->errors()->first(),
                    ],
                    400,
                );
            }

            // Determine if login is email or username
            $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

            // Attempt to log the user in
            $credentials = [
                $login_type => $request->input('login'),
                'password' => $request->input('password'),
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // $token = $user->createToken('authToken')->accessToken;

                // Check if the user's email is verified
                // if (!$user->is_verified) {
                //     // Log the user out if they are not verified
                //     Auth::logout();

                //     return response()->json(
                //         [
                //             'status' => 'error',
                //             'message' => 'Your email is not verified. Please verify your email before logging in.',
                //         ],
                //         403,
                //     );
                // }

                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Login successful',
                        'data' => [
                            'user' => $user,
                            'token' => $user->token,
                        ],
                    ],
                    200,
                );
            } else {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Invalid login credentials',
                    ],
                    401,
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function registerUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_name' => 'required|unique:users,user_name',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'mobile_number' => 'numeric',
                'profile' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $validator->errors()->first(),
                    ],
                    302,
                );
            }

            // if ($request->hasFile('profile')) {
            //     $image = $request->file('profile');

            //     // Store the image in the 'public/users' directory
            //     $path = $image->store('users', 'public');

            //     // App URL
            //     $appurl = 'https://tortoise-new-emu.ngrok-free.app';

            //     // Generate a full URL to the image
            //     $imageUrl = $appurl . Storage::url($path);
            // } else {
            //     return response()->json(['error' => 'Image upload failed'], 400);
            // }

            $user = new User();
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->mobile_number = "";
            $user->profile = "";
            $user->token = "";
            $user->save();

            // Generate Token
            $token = $user->createToken('authToken')->plainTextToken;
            $user->token = $token;
            $user->save();

            // Generate Verification Token
            // $verificationToken = Str::random(60);
            // $user->verification_token = $verificationToken;
            // $user->save();

            // App URL
            // $appurl = 'https://tortoise-new-emu.ngrok-free.app';

            // Send Verification Email
            // $verificationUrl = url('/verify-email/' . $verificationToken);
            // $verificationUrl = $appurl . '/verify-email/' . $verificationToken;
            // Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'created successfully.',
                    'data' => $user,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ],
                302,
            );
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Invalid verification token.',
                ],
                400,
            );
        }

        $user->is_verified = 1;
        $user->email_verified_at = Carbon::now();
        $user->verification_token = null; // Clear the token after verification
        $user->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Email verified successfully.',
            ],
            200,
        );
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
