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
    public function exploreAllStartup()
    {
        // Fetch specific fields for all startups from the database
        $startups = Startup::select('id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity')->get();

        return response()->json(
            [
                'status' => 'success',
                'startups' => $startups,
            ],
            200,
        );
    }

    public function getAllStartups()
    {
        // Fetch all startups from the database
        $startups = Startup::all();

        return response()->json(
            [
                'status' => 'success',
                'startups' => $startups,
            ],
            200,
        );
    }

    public function getStartup($id)
    {
        // Fetch the startup by ID from the database
        $startup = Startup::find($id);

        // Check if the startup exists
        if ($startup) {
            // Increment the view count
            $startup->increment('startup_view_count');

            return response()->json(
                [
                    'status' => 'success',
                    'startup' => $startup,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Startup not found',
                ],
                404,
            );
        }
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
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'startup_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'startup_name' => 'required|string',
                'year' => 'required|integer|digits:4',
                'location' => 'required|string',
                'total_funding' => 'required|string',
                'latest_funding' => 'required|string',
                'latest_investor' => 'required|string',
                'total_investor' => 'required|integer',
                'funding_round' => 'required|integer',
                'post_money_valuation' => 'required|string',
                'employee_count' => 'required|integer',
                'startup_description' => 'required|string',
                'startup_valuation' => 'required|string',
                'startup_equity' => 'required|string|min:0|max:100',
                'startup_url' => 'required|url',
                'email' => 'required|email',
                'phone_number' => 'required|string|min:10|max:15',
                'first_covered' => 'required|date_format:Y-m-d',
            ]);

            // If validation fails, return the error
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
            if ($request->hasFile('startup_image')) {
                $image = $request->file('startup_image');
                $path = $image->store('startups', 'public');
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            // Insert startup data into the database
            $startup = new Startup();
            $startup->startup_image = $imageUrl;
            $startup->startup_name = $request->startup_name;
            $startup->year = $request->year;
            $startup->location = $request->location;
            $startup->total_funding = $request->total_funding;
            $startup->latest_funding = $request->latest_funding;
            $startup->latest_investor = $request->latest_investor;
            $startup->total_investor = $request->total_investor;
            $startup->funding_round = $request->funding_round;
            $startup->post_money_valuation = $request->post_money_valuation;
            $startup->employee_count = $request->employee_count;
            $startup->startup_description = $request->startup_description;
            $startup->startup_valuation = $request->startup_valuation;
            $startup->startup_equity = $request->startup_equity;
            $startup->startup_view_count = 0;
            $startup->startup_url = $request->startup_url;
            $startup->email = $request->email;
            $startup->phone_number = $request->phone_number;
            $startup->first_covered = $request->first_covered;
            $startup->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Startup created successfully.',
                    'data' => $startup,
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

    public function show($id)
    {
        $startup = Startup::with(['valuations', 'fundingRounds', 'competitors'])->findOrFail($id);

        return response()->json([
            'data' => [
                'image_url' => $startup->startup_image,
                'name' => $startup->startup_name,
                'year' => $startup->year,
                'location' => $startup->location,
                'valuation' => $startup->valuations->map(function ($valuation) {
                    return [
                        'year' => $valuation->year,
                        'value' => $valuation->value,
                    ];
                }),
                'total_funding' => $startup->total_funding,
                'latest_funding' => $startup->latest_funding,
                'latest_investor' => $startup->latest_investor,
                'total_investor' => $startup->total_investor,
                'funding_round' => $startup->funding_round,
                'post_money_valuation' => $startup->post_money_valuation,
                'Employee' => $startup->employee_count,
                'description' => $startup->startup_description,
                'url' => $startup->startup_url,
                'email' => $startup->email,
                'phone_number' => $startup->phone_number,
                'first_covered' => $startup->first_covered,
                'total_funding_round' => $startup->funding_round,
                'funding_round' => $startup->fundingRounds->map(function ($round) {
                    return [
                        'date' => $round->date,
                        'round_name' => $round->round_name,
                        'amount' => $round->amount,
                        'investor' => $round->investor,
                    ];
                }),
                'competitors' => $startup->competitors->map(function ($competitor) {
                    return [
                        'image_url' => $competitor->image_url,
                        'name' => $competitor->name,
                        'subtitle' => $competitor->subtitle,
                        'founded_year' => $competitor->founded_year,
                        'funding' => $competitor->funding,
                        'location' => $competitor->location,
                        'investor' => $competitor->investor,
                        'stage' => $competitor->stage,
                        'description' => $competitor->description,
                    ];
                }),
            ],
        ]);
    }
}
