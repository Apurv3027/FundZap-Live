<?php

namespace App\Http\Controllers;

use App\Models\VentureCapital;
use Illuminate\Http\Request;
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

class VentureCapitalController extends Controller
{
    public function addVentureCapitalDetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'vc_name' => 'required|string',
                'vc_category' => 'required|string',
                'vc_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'vc_description' => 'required|string',
                'vc_url' => 'required|string',
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

            // Image Upload
            if ($request->hasFile('vc_image')) {
                $image = $request->file('vc_image');

                // Store the image in the 'public/venturecapitals' directory
                $path = $image->store('venturecapitals', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            $ventureCapital = new VentureCapital();
            $ventureCapital->vc_name = $request->vc_name;
            $ventureCapital->vc_category = $request->vc_category;
            $ventureCapital->vc_image = $imageUrl;
            $ventureCapital->vc_description = $request->vc_description;
            $ventureCapital->vc_url = $request->vc_url;
            $ventureCapital->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'created successfully.',
                    'data' => $ventureCapital,
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

    // Index Venture Capitals
    public function indexVentureCapitals()
    {
        try {
            $ventureCapitals = VentureCapital::select('vc_name', 'vc_image', 'vc_category')->get();

            if ($ventureCapitals->isEmpty()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'No venture capital details found.',
                    ],
                    404,
                );
            }

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'data' => $ventureCapitals,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function getVentureCapitalDetails($id)
    {
        try {
            // Fetch the venture capital by ID along with its associated portfolios
            $ventureCapital = VentureCapital::with('portfolios')->find($id);

            // Check if the venture capital entry exists
            if (!$ventureCapital) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Venture Capital not found.',
                    ],
                    404,
                );
            }

            return response()->json(
                [
                    'status' => 'success',
                    'data' => $ventureCapital,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
