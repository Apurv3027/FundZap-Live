<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
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

class PortfolioController extends Controller
{
    public function addStartupPortfolio(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'pf_startup_name' => 'required|string',
                'pf_startup_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'pf_startup_url' => 'required|string',
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
            if ($request->hasFile('pf_startup_image')) {
                $image = $request->file('pf_startup_image');

                // Store the image in the 'public/startupportfolio' directory
                $path = $image->store('startupportfolio', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);

            } else {
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            $startupPortfolio = new Portfolio();
            $startupPortfolio->venture_capital_id = $request->venture_capital_id;
            $startupPortfolio->pf_startup_name = $request->pf_startup_name;
            $startupPortfolio->pf_startup_image = $imageUrl;
            $startupPortfolio->pf_startup_url = $request->pf_startup_url;
            $startupPortfolio->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'created successfully.',
                    'data' => $startupPortfolio,
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
