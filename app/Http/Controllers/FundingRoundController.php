<?php

namespace App\Http\Controllers;

use App\Models\FundingRound;
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

class FundingRoundController extends Controller
{
    public function addFundingRound(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_id' => 'required|exists:startups,id',
                'date' => 'required|date_format:Y-m-d',
                'round_name' => 'required|string',
                'amount' => 'required|string',
                'investor' => 'required|string',
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

            $fundingRound = new FundingRound();
            $fundingRound->startup_id = $request->startup_id;
            $fundingRound->date = $request->date;
            $fundingRound->round_name = $request->round_name;
            $fundingRound->amount = $request->amount;
            $fundingRound->investor = $request->investor;
            $fundingRound->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Funding round created successfully.',
                    'data' => $fundingRound,
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
