<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\Competitor;
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

class AdminCompetitorController extends Controller
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

        return view('admin.startups.competitors', compact('startup_id', 'startup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $startup_id)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'image_url' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'name' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'founded_year' => 'required|integer|digits:4',
                'funding' => 'required|numeric|min:0',
                'location' => 'required|string|max:255',
                'investor' => 'nullable|string|max:255',
                'stage' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            // Check for validation errors
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Image Upload
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $path = $image->store('startups/competitors', 'public');
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return redirect()->back()->with('error', 'Image upload failed');
            }

            // Create a new competitor
            $competitor = new Competitor();
            $competitor->startup_id = $startup_id;
            $competitor->image_url = $imageUrl;
            $competitor->name = $request->name;
            $competitor->subtitle = $request->subtitle;
            $competitor->founded_year = $request->founded_year;
            $competitor->funding = $request->funding;
            $competitor->location = $request->location;
            $competitor->investor = $request->investor;
            $competitor->stage = $request->stage;
            $competitor->description = $request->description;
            $competitor->save();

            return redirect()
                ->route('admin.startups.show', ['id' => $startup_id])
                ->with('success', 'Competitor created successfully.');
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
