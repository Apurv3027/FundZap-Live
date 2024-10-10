<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
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

class CompetitorController extends Controller
{
    public function addCompetitor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_id' => 'required|exists:startups,id',
                'image_url' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'name' => 'required|string',
                'subtitle' => 'nullable|string',
                'founded_year' => 'required|integer|digits:4',
                'funding' => 'required|string',
                'location' => 'required|string',
                'investor' => 'nullable|string',
                'stage' => 'required|string',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $validator->errors()->first(),
                    ],
                    422,
                );
            }

            // Image Upload
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $path = $image->store('startups/competitors', 'public');
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            $competitor = new Competitor();
            $competitor->startup_id = $request->startup_id;
            $competitor->image_url = $imageUrl;
            $competitor->name = $request->name;
            $competitor->subtitle = $request->subtitle;
            $competitor->founded_year = $request->founded_year;
            $competitor->funding = $request->funding;
            $competitor->location = $request->location;
            $competitor->investor = $request->investor;
            $competitor->stage = $request->stage;
            $competitor->description = $request->description;
            $competitor->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Competitor created successfully.',
                    'data' => $competitor,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
