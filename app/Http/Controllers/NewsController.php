<?php

namespace App\Http\Controllers;

use App\Models\News;
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

class NewsController extends Controller
{
    public function getAllNews()
    {
        // Fetch all news from the database
        $news = News::all();

        return response()->json(
            [
                'status' => 'success',
                'news' => $news,
            ],
            200,
        );
    }

    public function getLatestNews()
    {
        // Fetch the top 4 latest news from the database based on the current date
        $news = News::where('date', '<=', now())->orderBy('date', 'desc')->take(4)->get();

        return response()->json(
            [
                'status' => 'success',
                'news' => $news,
            ],
            200,
        );
    }

    public function uploadNewsImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image in the 'public/news' directory
            $path = $image->store('news', 'public');

            // App URL
            $appurl = 'https://tortoise-new-emu.ngrok-free.app';

            // Generate a full URL to the image
            $url = $appurl . Storage::url($path);

            // Return the full URL so it can be accessed via the API
            return response()->json(['image_url' => url($url)], 200);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }

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
    public function create()
    {
        //
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
                'date' => 'required|string|date_format:d/m/Y',
                'url' => 'required|string',
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
                return response()->json(['error' => 'Image upload failed'], 400);
            }

            // Check Date Format
            $date = DateTime::createFromFormat('d/m/Y', $request->date);
            if (!$date || $date->format('d/m/Y') !== $request->date) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Invalid date format. Please use DD/MM/YYYY.',
                    ],
                    302,
                );
            }

            $news = new News();
            $news->image_url = $imageUrl;
            $news->company_name = $request->company_name;
            $news->news = $request->news;
            $news->date = $date->format('Y-m-d');
            $news->url = $request->url;
            $news->save();

            return response()->json(
                [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'created successfully.',
                    'data' => $news,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                ],
                302,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
