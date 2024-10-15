<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
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

class AdminStartupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $startups = Startup::select(['id', 'startup_name', 'startup_description', 'startup_valuation', 'startup_equity', 'startup_url']);
            return DataTables::of($startups)
                ->addIndexColumn()
                ->editColumn('startup_url', function ($startup) {
                    return '<a href="' . $startup->startup_url . '" target="_blank">' . $startup->startup_url . '</a>';
                })
                ->addColumn('action', function ($n) {
                    $editLink = URL::to('/') . '/admin/startups/' . $n->id . '/edit';
                    $viewLink = URL::to('/') . '/admin/startups/' . $n->id;

                    return Helper::Action($editLink, $n->id, $viewLink);

                    // return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                    //         <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['startup_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.startups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.startups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'startup_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'startup_name' => 'required|string|max:255',
                'year' => 'required|integer|digits:4',
                'location' => 'required|string|max:255',
                'total_funding' => 'required|numeric|min:0',
                'latest_funding' => 'nullable|numeric|min:0',
                'latest_investor' => 'nullable|string|max:255',
                'total_investor' => 'nullable|integer|min:0',
                'funding_round' => 'nullable|string|max:255',
                'post_money_valuation' => 'nullable|numeric|min:0',
                'employee_count' => 'nullable|integer|min:0',
                'startup_description' => 'required|string',
                'startup_valuation' => 'required|numeric|min:0',
                'startup_equity' => 'required|numeric|min:0|max:100',
                'startup_url' => 'required|url',
                'email' => 'nullable|email|max:255',
                'phone_number' => 'nullable|string|max:20',
                'first_covered' => 'nullable|date',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Handle image upload
            if ($request->hasFile('startup_image')) {
                $image = $request->file('startup_image');

                // Store the image in the public/startups directory
                $path = $image->store('startups', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);
            } else {
                return back()
                    ->withInput()
                    ->withErrors(['startup_image' => 'Image upload failed']);
            }

            // Create a new Startup instance
            $startup = new Startup();
            $startup->startup_image = $imageUrl;
            $startup->startup_name = $request->startup_name;
            $startup->year = $request->year;
            $startup->location = $request->location;
            $startup->total_funding = $request->total_funding;
            $startup->latest_funding = $request->latest_funding;
            $startup->latest_investor = $request->latest_investor;
            $startup->total_investor = $request->total_investor;
            $startup->funding_round = $request->funding_round;
            $startup->post_money_valuation = $request->post_money_valuation;
            $startup->employee_count = $request->employee_count;
            $startup->startup_description = $request->startup_description;
            $startup->startup_valuation = $request->startup_valuation;
            $startup->startup_equity = $request->startup_equity;
            $startup->startup_view_count = 0; // Default value for views
            $startup->startup_url = $request->startup_url;
            $startup->email = $request->email;
            $startup->phone_number = $request->phone_number;
            $startup->first_covered = $request->first_covered;

            // Save the startup record
            $startup->save();

            // Redirect with success message
            return redirect()->route('admin.startups')->with('success', 'Startup created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $startup = Startup::with(['valuations', 'fundingRounds', 'competitors'])->findOrFail($id);

        // Remove the base URL if present in startup_image
        $startup->startup_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $startup->startup_image);

        // Remove base URL from each competitor's image if present
        foreach ($startup->competitors as $competitor) {
            $competitor->image_url = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $competitor->image_url);
        }

        return view('admin.startups.show', compact('startup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $startup = Startup::findOrFail($id);

        // Remove the base URL if present in startup_image
        $startup->startup_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $startup->startup_image);

        return view('admin.startups.edit', compact('startup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'startup_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'startup_name' => 'required|string|max:255',
                'startup_description' => 'required|string',
                'startup_valuation' => 'required|numeric|min:0',
                'startup_equity' => 'required|numeric|min:0|max:100',
                'startup_url' => 'required|url',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Find the startup entry
            $startup = Startup::findOrFail($id);

            // Handle image upload if present
            if ($request->hasFile('startup_image')) {
                $image = $request->file('startup_image');

                // Store the image in the 'public/startups' directory
                $path = $image->store('startups', 'public');

                // Get base URL from environment variables
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate full URL for the image
                $imageUrl = $appurl . Storage::url($path);

                // Update image URL in the startup record
                $startup->startup_image = $imageUrl;
            }

            // Update the other fields
            $startup->startup_name = $request->startup_name;
            $startup->startup_description = $request->startup_description;
            $startup->startup_valuation = $request->startup_valuation;
            $startup->startup_equity = $request->startup_equity;
            $startup->startup_url = $request->startup_url;

            // Save the updated startup record
            $startup->save();

            // Redirect with a success message
            return redirect()->route('admin.startups')->with('success', 'Startup updated successfully!');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return back()->withErrors(['error' => 'An error occurred while updating the startup.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Startup::where('id', $id)->delete();
            return Response::json($data);
        } catch (\Exception $e) {
            Log::error('AdminStartupController->destroy' . $e->getCode());
        }
    }
}
