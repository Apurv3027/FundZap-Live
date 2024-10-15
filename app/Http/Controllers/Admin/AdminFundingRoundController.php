<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\FundingRound;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;
use App\Helper\helper;

class AdminFundingRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($startup_id)
    {
        $startup = Startup::findOrFail($startup_id);

        return view('admin.startups.fundinground', compact('startup_id', 'startup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $startup_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_id' => 'required|exists:startups,id',
                'date' => 'required|date',
                'round_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0',
                'investor' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fundingRound = new FundingRound();
            $fundingRound->startup_id = $startup_id;
            $fundingRound->date = $request->date;
            $fundingRound->round_name = $request->round_name;
            $fundingRound->amount = $request->amount;
            $fundingRound->investor = $request->investor;
            $fundingRound->save();

            return redirect()
                ->route('admin.startups.show', ['id' => $startup_id])
                ->with('success', 'Funding round created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
