<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
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

class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $news = News::select(['id', 'company_name', 'news', 'url', 'date']);
            return DataTables::of($news)
                ->addIndexColumn()
                ->editColumn('url', function ($ne) {
                    return '<a href="' . $ne->url . '" target="_blank">' . $ne->url . '</a>';
                })
                ->editColumn('date', function ($n) {
                    return !empty($n->date) ? \Carbon\Carbon::parse($n->date)->format('d/m/Y') : '-';
                })
                ->addColumn('action', function ($n) {
                    $editLink = URL::to('/') . '/admin/news/' . $n->id . '/edit';
                    $viewLink = URL::to('/') . '/admin/news/' . $n->id;

                    return Helper::Action($editLink, $n->id, $viewLink);

                    // return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                    //         <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['url', 'date', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image_url' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'company_name' => 'required|string',
                'news' => 'required|string',
                'date' => 'required|string',
                'url' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Image Upload
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');

                // Store the image in the public/news directory
                $path = $image->store('news', 'public');

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

            $news = new News();
            $news->image_url = $imageUrl;
            $news->company_name = $request->company_name;
            $news->news = $request->news;
            $news->date = $request->date;
            $news->url = $request->url;

            $news->save();

            // Redirect with success message
            return redirect()->route('admin.news')->with('success', 'News created successfully.');

            // return response()->json(
            //     [
            //         'code' => 200,
            //         'status' => 'success',
            //         'message' => 'created successfully.',
            //         'data' => $news,
            //     ],
            //     200,
            // );
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        // Remove the base URL if present in image_url
        $news->image_url = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $news->image_url);

        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $news = News::findOrFail($id);
        // return view('admin.news.edit', compact('news'));

        $news = News::findOrFail($id);

        // Remove the base URL if present in image_url
        $news->image_url = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $news->image_url);

        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'image_url' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
                'company_name' => 'required|string',
                'news' => 'required|string',
                'date' => 'required',
                'url' => 'required|url',
            ]);

            // Handle validation failure
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            // Find the news entry
            $news = News::findOrFail($id);

            // Handle image upload if present
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');

                // Store the image in the 'public/news' directory
                $path = $image->store('news', 'public');

                // Get base URL from environment variables
                $appurl = 'https://tortoise-new-emu.ngrok-free.app';

                // Generate full URL for the image
                $imageUrl = $appurl . Storage::url($path);

                // Update image URL in the news record
                $news->image_url = $imageUrl;
            }

            // Update the other fields
            $news->company_name = $request->company_name;
            $news->news = $request->news;
            $news->date = $request->date;
            $news->url = $request->url;

            // Save the updated news record
            $news->save();

            // Redirect with a success message
            return redirect()->route('admin.news')->with('success', 'News updated successfully!');
        } catch (\Exception $e) {
            // Handle unexpected errors
            return back()->withErrors(['error' => 'An error occurred while updating the news.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = News::where('id', $id)->delete();
            return Response::json($data);
        } catch (\Exception $e) {
            Log::error('AdminNewsController->destroy' . $e->getCode());
        }
    }
}
