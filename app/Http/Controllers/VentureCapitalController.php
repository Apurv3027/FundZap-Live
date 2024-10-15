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
                'subtitle' => 'required|string',
                'team_member' => 'required|string',
                'founded_year' => 'required|integer|min:1900|max:' . date('Y'), // Validate year
                'portfolio_count' => 'required|integer',
                'portfolio_sector' => 'required|string',
                'portfolio_location' => 'required|string',
                'portfolio_unicorns' => 'required|integer',
                'deals_12_month' => 'required|integer',
                'status' => 'required|string',
                'is_seed' => 'required|boolean',
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
            $ventureCapital->subtitle = $request->subtitle;
            $ventureCapital->team_member = $request->team_member;
            $ventureCapital->founded_year = $request->founded_year;
            $ventureCapital->portfolio_count = $request->portfolio_count;
            $ventureCapital->portfolio_sector = $request->portfolio_sector;
            $ventureCapital->portfolio_location = $request->portfolio_location;
            $ventureCapital->portfolio_unicorns = $request->portfolio_unicorns;
            $ventureCapital->deals_12_month = $request->deals_12_month;
            $ventureCapital->status = $request->status;
            $ventureCapital->is_seed = $request->is_seed;
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
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    // Index Venture Capitals
    public function indexVentureCapitals()
    {
        try {
            $ventureCapitals = VentureCapital::with(['investments', 'sectors', 'countries', 'portfolios'])->get();

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
            $vc = VentureCapital::with(['investments', 'sectors', 'countries', 'portfolios'])->findOrFail($id);

            return response()->json(
                [
                    'id' => $vc->id,
                    'image_url' => $vc->vc_image,
                    'name' => $vc->vc_name,
                    'subtitle' => $vc->subtitle,
                    'investment' => $vc->investments->map(function ($investment) {
                        return [
                            'stage' => $investment->stage,
                            'no_startup' => $investment->no_startup,
                        ];
                    }),
                    'sector' => $vc->sectors->map(function ($sector) {
                        return [
                            'name' => $sector->name,
                            'value' => $sector->value,
                        ];
                    }),
                    'description' => $vc->vc_description,
                    'team_member' => $vc->team_member,
                    'founded_year' => $vc->founded_year,
                    'portfolio_count' => $vc->portfolio_count,
                    'portfolio_sector' => $vc->portfolio_sector,
                    'portfolio_location' => $vc->portfolio_location,
                    'portfolio_unicorns' => $vc->portfolio_unicorns,
                    'deals_12_month' => $vc->deals_12_month,
                    'country' => $vc->countries->map(function ($country) {
                        return [
                            'name' => $country->name,
                            'value' => $country->value,
                        ];
                    }),
                    'portfolio' => $vc->portfolios->map(function ($portfolio) {
                        return [
                            'image_url' => $portfolio->pf_startup_image,
                            'name' => $portfolio->pf_startup_name,
                            'subtitle' => $portfolio->subtitle,
                            'founded_year' => $portfolio->founded_year,
                            'funding' => $portfolio->funding,
                            'location' => $portfolio->location,
                            'investor' => $portfolio->investor,
                            'stage' => $portfolio->stage,
                        ];
                    }),
                    'status' => $vc->status,
                    'isSeed' => $vc->is_seed,
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
