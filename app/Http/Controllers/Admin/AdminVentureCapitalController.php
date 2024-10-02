<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentureCapital;
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

class AdminVentureCapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ventureCapitals = VentureCapital::select(['id', 'vc_name', 'vc_category', 'vc_description', 'vc_url']);
            return DataTables::of($ventureCapitals)
                ->addIndexColumn()
                ->editColumn('vc_url', function ($startup) {
                    return '<a href="' . $startup->vc_url . '" target="_blank">' . $startup->vc_url . '</a>';
                })
                ->addColumn('action', function ($n) {

                    $editLink = URL::to('/') . '/admin/venture/' . $n->id . '/edit';
                    $viewLink = URL::to('/') . '/admin/venture/' . $n->id;

                    return Helper::Action($editLink, $n->id, $viewLink);

                    // return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                    //         <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['vc_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.venture-capital.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.venture-capital.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'vc_name' => 'required|string',
                'vc_category' => 'required|string',
                'vc_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'vc_description' => 'required|string',
                'vc_url' => 'required|url',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Handle image upload if present
            if ($request->hasFile('vc_image')) {
                $image = $request->file('vc_image');

                // Store the image in the 'public/venturecapitals' directory
                $path = $image->store('venturecapitals', 'public');

                // Get base URL from environment variables
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate full URL for the image
                $imageUrl = $appurl . Storage::url($path);
            } else {
                $imageUrl = null; // No image provided
            }

            // Create a new VentureCapital entry
            $ventureCapital = new VentureCapital();
            $ventureCapital->vc_name = $request->vc_name;
            $ventureCapital->vc_category = $request->vc_category;
            $ventureCapital->vc_image = $imageUrl;
            $ventureCapital->vc_description = $request->vc_description;
            $ventureCapital->vc_url = $request->vc_url;

            // Save the new venture capital record
            $ventureCapital->save();

            // Redirect with success message
            return redirect()->route('admin.venture')->with('success', 'Venture Capital created successfully.');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ventureCapital = VentureCapital::findOrFail($id);

        // Remove the base URL if present in vc_image
        $ventureCapital->vc_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $ventureCapital->vc_image);

        return view('admin.venture-capital.show', compact('ventureCapital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ventureCapital = VentureCapital::findOrFail($id);

        // Remove the base URL if present in vc_image
        $ventureCapital->vc_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $ventureCapital->vc_image);

        return view('admin.venture-capital.edit', compact('ventureCapital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'vc_name' => 'required|string',
                'vc_category' => 'required|string',
                'vc_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'vc_description' => 'required|string',
                'vc_url' => 'required|url',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Find the venture capital entry
            $ventureCapital = VentureCapital::findOrFail($id);

            // Handle image upload if present
            if ($request->hasFile('vc_image')) {
                $image = $request->file('vc_image');

                // Store the image in the 'public/venturecapitals' directory
                $path = $image->store('venturecapitals', 'public');

                // Get base URL from environment variables
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate full URL for the image
                $imageUrl = $appurl . Storage::url($path);

                // Update the image URL in the venture capital record
                $ventureCapital->vc_image = $imageUrl;
            }

            // Update the other fields
            $ventureCapital->vc_name = $request->vc_name;
            $ventureCapital->vc_category = $request->vc_category;
            $ventureCapital->vc_description = $request->vc_description;
            $ventureCapital->vc_url = $request->vc_url;

            // Save the updated venture capital record
            $ventureCapital->save();

            // Redirect with a success message
            return redirect()->route('admin.venture')->with('success', 'Venture Capital updated successfully!');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return back()->withErrors(['error' => 'An error occurred while updating the Venture Capital.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = VentureCapital::where('id', $id)->delete();
            return Response::json($data);
        } catch (\Exception $e) {
            Log::error('AdminVentureCapitalController->destroy' . $e->getCode());
        }
    }
}
