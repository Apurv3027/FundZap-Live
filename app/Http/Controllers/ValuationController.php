<?php

namespace App\Http\Controllers;

use App\Models\Valuation;
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

class ValuationController extends Controller
{
    public function addValuation(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_id' => 'required|exists:startups,id',
                'year' => 'required|integer|digits:4',
                'value' => 'required|numeric|min:0',
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

            $valuation = new Valuation();
            $valuation->startup_id = $request->startup_id;
            $valuation->year = $request->year;
            $valuation->value = $request->value;
            $valuation->save();

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Valuation added successfully.',
                    'data' => $valuation,
                ],
                201,
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
