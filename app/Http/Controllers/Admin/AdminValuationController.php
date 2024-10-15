<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\Valuation;
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

class AdminValuationController extends Controller
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

        return view('admin.startups.valuation', compact('startup_id', 'startup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $startup_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'startup_id' => 'required|exists:startups,id',
                'year' => 'required|integer|digits:4',
                'value' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $valuation = new Valuation();
            $valuation->startup_id = $startup_id;
            $valuation->year = $request->year;
            $valuation->value = $request->value;
            $valuation->save();

            return redirect()
                ->route('admin.startups.show', ['id' => $startup_id])
                ->with('success', 'Valuation created successfully.');
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
