<?php

namespace App\Http\Controllers;
use App\Models\Sector;
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

class SectorController extends Controller
{
    public function addSector(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'name' => 'required|string',
                'value' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $validator->errors()->first(),
                    ],
                    400,
                );
            }

            $sector = new Sector();
            $sector->venture_capital_id = $request->venture_capital_id;
            $sector->name = $request->name;
            $sector->value = $request->value;
            $sector->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Sector added successfully.',
                    'data' => $sector,
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
