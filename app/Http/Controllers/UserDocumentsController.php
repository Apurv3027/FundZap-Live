<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDocuments;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\VentureCapital;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helper\Helper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;

class UserDocumentsController extends Controller
{
    public function getAllUserDocuments()
    {
        try {
            // Retrieve user documents
            $userDocuments = User::with('documents')->get();

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $userDocuments,
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

    public function getUnverifiedDocuments()
    {
        // Fetch users with unverified documents
        $unverifiedUsers = User::where('document_verified', false)->whereHas('documents')->with('documents')->get();

        if ($unverifiedUsers->isEmpty()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'No unverified documents found.',
                ],
                404,
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => $unverifiedUsers,
            ],
            200,
        );
    }

    public function uploadDocuments(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'pin_code' => 'required|string',
                'city' => 'required|string',
                'selfie_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'aadhar_front_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'aadhar_back_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'pan_card_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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

            // Check if user_id already has documents in the documents table
            $existingDocument = UserDocuments::where('user_id', $request->user_id)->first();
            if ($existingDocument) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Documents for this user are already uploaded.',
                    ],
                    409,
                ); // HTTP status code 409: Conflict
            }

            // Check if user_id exists in users table
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Handle file uploads
            if ($request->hasFile('selfie_photo') && $request->hasFile('aadhar_front_image') && $request->hasFile('aadhar_back_image') && $request->hasFile('pan_card_image')) {
                $selfiePath = $request->file('selfie_photo')->store('users/documents/selfie', 'public');
                $aadharFrontPath = $request->file('aadhar_front_image')->store('users/documents/aadhar/front', 'public');
                $aadharBackPath = $request->file('aadhar_back_image')->store('users/documents/aadhar/back', 'public');
                $panCardPath = $request->file('pan_card_image')->store('users/documents/pan', 'public');

                $appurl = 'https://tortoise-new-emu.ngrok-free.app';
                $selfiePhotoUrl = $appurl . Storage::url($selfiePath);
                $aadharFrontUrl = $appurl . Storage::url($aadharFrontPath);
                $aadharBackUrl = $appurl . Storage::url($aadharBackPath);
                $panCardUrl = $appurl . Storage::url($panCardPath);
            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            // Create user_document record
            $user_document = new UserDocuments();
            $user_document->user_id = $request->user_id;
            $user_document->first_name = $request->first_name;
            $user_document->last_name = $request->last_name;
            $user_document->email = $request->email;
            $user_document->phone_number = $request->phone_number;
            $user_document->pin_code = $request->pin_code;
            $user_document->city = $request->city;
            $user_document->selfie_photo = $selfiePhotoUrl;
            $user_document->aadhar_front_image = $aadharFrontUrl;
            $user_document->aadhar_back_image = $aadharBackUrl;
            $user_document->pan_card_image = $panCardUrl;

            $user_document->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'User Documents uploaded successfully.',
                    'data' => $user_document,
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

    public function verifyDocuments(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Retrieve user documents
        $userDocuments = UserDocuments::where('user_id', $id)->first();

        if ($userDocuments) {
            // Update user's mobile number
            $user->mobile_number = $userDocuments->phone_number;

            $user->document_verified = true;
            $user->save();

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Documents verified successfully.',
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'No documents found for this user.',
                ],
                404,
            );
        }
    }
}
