<?php

namespace App\Http\Controllers;

use App\Models\Startup;
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

class StartupController extends Controller
{
    public function getAllStartups()
    {
        // Fetch all startups from the database
        $startups = Startup::all();

        return response()->json(
            [
                'status' => 'success',
                'news' => $startups,
            ],
            200,
        );
    }

    public function getMostViewedStartups()
    {
        // Fetch the top 4 most viewed startups from the database
        $startups = Startup::orderBy('startup_view_count', 'desc')->take(4)->get();

        return response()->json(
            [
                'status' => 'success',
                'startups' => $startups,
            ],
            200,
        );
    }

    public function uploadStartupImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image in the 'public/startups' directory
            $path = $image->store('startups', 'public');

            // App URL
            $appurl = 'https://tortoise-new-emu.ngrok-free.app';

            // Generate a full URL to the image
            $url = $appurl . Storage::url($path);

            // Return the full URL so it can be accessed via the API
            return response()->json(['startup_image' => url($url)], 200);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }

    public function addStartup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'startup_name' => 'required|string',
                'startup_valuation' => 'required|numeric',
                'startup_equity' => 'required|numeric',
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
            if ($request->hasFile('startup_image')) {
                $image = $request->file('startup_image');

                // Store the image in the 'public/startups' directory
                $path = $image->store('startups', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);

            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            $startup = new Startup();
            $startup->startup_image = $imageUrl;
            $startup->startup_name = $request->startup_name;
            $startup->startup_valuation = $request->startup_valuation;
            $startup->startup_equity = $request->startup_equity;
            $startup->startup_view_count = 0;
            $startup->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'created successfully.',
                    'data' => $startup,
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
}
