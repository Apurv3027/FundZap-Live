<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Helper\Helper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function checkEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
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

            // Check if email is exist or not
            $user = User::where('email', $request->email)->first();

            if ($user) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Email exists in database',
                        'email_exists' => true,
                        'token' => $user->token,
                    ],
                    200,
                );
            } else {
                // Email does not exist
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'email does not exist in database',
                        'email_exists' => false,
                    ],
                    404,
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            // Validate the request inputs
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'token' => 'required',
                'password' => 'required|min:6',
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

            // Find the user exist with email or not
            $user = User::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid token or email',
                ], 404);
            }

            // Check if the new password is the same as the old one
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'New password cannot be the same as the old password',
                ], 400);
            }

            // Update User's Password
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully',
                'data' => [
                    'user' => $user,
                    'token' => $user->token,
                ],
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 302);
        }
    }
}
