<?php

namespace App\Http\Controllers;
use App\Models\Investment;
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

class InvestmentController extends Controller
{
    public function addInvestment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'stage' => 'required|string',
                'no_startup' => 'required|integer|min:1',
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

            $investment = new Investment();
            $investment->venture_capital_id = $request->venture_capital_id;
            $investment->stage = $request->stage;
            $investment->no_startup = $request->no_startup;
            $investment->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Investment added successfully.',
                    'data' => $investment,
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
