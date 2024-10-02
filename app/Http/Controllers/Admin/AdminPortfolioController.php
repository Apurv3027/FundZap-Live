<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
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

class AdminPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $portfolio = Portfolio::with('ventureCapital:id,vc_name')
                                ->select(['id', 'venture_capital_id', 'pf_startup_name', 'pf_startup_url']);
            return DataTables::of($portfolio)
                ->addIndexColumn()
                ->editColumn('venture_capital_id', function ($portfolio) {
                    // Access the venture_capital_name from the related VentureCapital model
                    return $portfolio->ventureCapital ? $portfolio->ventureCapital->vc_name : 'N/A';
                })
                ->editColumn('pf_startup_url', function ($ne) {
                    return '<a href="' . $ne->pf_startup_url . '" target="_blank">' . $ne->pf_startup_url . '</a>';
                })
                ->addColumn('action', function ($n) {

                    $editLink = URL::to('/') . '/admin/portfolio/' . $n->id . '/edit';
                    $viewLink = URL::to('/') . '/admin/portfolio/' . $n->id;

                    return Helper::Action($editLink, $n->id, $viewLink);
                })
                ->rawColumns(['venture_capital_id', 'pf_startup_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.portfolio.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventureCapitals = VentureCapital::all();
        return view('admin.portfolio.create', compact('ventureCapitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'pf_startup_name' => 'required|string',
                'pf_startup_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'pf_startup_url' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Image Upload
            if ($request->hasFile('pf_startup_image')) {
                $image = $request->file('pf_startup_image');

                // Store the image in the public/startupportfolio directory
                $path = $image->store('startupportfolio', 'public');

                // App URL
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate a full URL to the image
                $imageUrl = $appurl . Storage::url($path);
            } else {
                // return response()->json(['error' => 'Image upload failed'], 400);
                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Image upload failed']);
            }

            $startupPortfolio = new Portfolio();
            $startupPortfolio->venture_capital_id = $request->venture_capital_id;
            $startupPortfolio->pf_startup_name = $request->pf_startup_name;
            $startupPortfolio->pf_startup_image = $imageUrl;
            $startupPortfolio->pf_startup_url = $request->pf_startup_url;

            $startupPortfolio->save();

            // Redirect with success message
            return redirect()->route('admin.portfolio')->with('success', 'Portfolio created successfully.');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $ventureCapitals = VentureCapital::findOrFail($id);

        // Remove the base URL if present in pf_startup_image
        $portfolio->pf_startup_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $portfolio->pf_startup_image);

        return view('admin.portfolio.show', compact('portfolio', 'ventureCapitals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $ventureCapitals = VentureCapital::all();

        // Remove the base URL if present in pf_startup_image
        $portfolio->pf_startup_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $portfolio->pf_startup_image);

        return view('admin.portfolio.edit', compact('portfolio', 'ventureCapitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'venture_capital_id' => 'required|exists:venture_capitals,id',
                'pf_startup_name' => 'required|string',
                'pf_startup_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'pf_startup_url' => 'required|string',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Find the portfolio entry
            $portfolio = Portfolio::findOrFail($id);

            // Handle image upload if present
            if ($request->hasFile('pf_startup_image')) {
                $image = $request->file('pf_startup_image');

                // Store the image in the 'public/startupportfolio' directory
                $path = $image->store('startupportfolio', 'public');

                // Get base URL from environment variables
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate full URL for the image
                $imageUrl = $appurl . Storage::url($path);

                // Update image URL in the portfolio record
                $portfolio->pf_startup_image = $imageUrl;
            }

            // Update the other fields
            $portfolio->venture_capital_id = $request->venture_capital_id;
            $portfolio->pf_startup_name = $request->pf_startup_name;
            $portfolio->pf_startup_url = $request->pf_startup_url;

            // Save the updated news record
            $portfolio->save();

            // Redirect with a success message
            return redirect()->route('admin.portfolio')->with('success', 'Portfolio updated successfully!');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return back()->withErrors(['error' => 'An error occurred while updating the portfolio.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Portfolio::where('id', $id)->delete();
            return Response::json($data);
        } catch (\Exception $e) {
            Log::error('AdminPortfolioController->destroy' . $e->getCode());
        }
    }
}
