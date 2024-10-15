<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentureCapital;
use App\Models\Investment;
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

class AdminInvestmentController extends Controller
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
    public function create($venture_capital_id)
    {
        $venture_capital = VentureCapital::findOrFail($venture_capital_id);

        return view('admin.venture-capital.investments', compact('venture_capital_id', 'venture_capital'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $venture_capital_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'stage' => 'required|string|max:255',
                'no_startup' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $investment = new Investment();
            $investment->venture_capital_id = $venture_capital_id;
            $investment->stage = $request->stage;
            $investment->no_startup = $request->no_startup;
            $investment->save();

            return redirect()->route('admin.venture.show', ['id' => $venture_capital_id])->with('success', 'Investment created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
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
