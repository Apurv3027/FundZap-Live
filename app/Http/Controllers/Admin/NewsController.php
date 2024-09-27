<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        // Fetch all News from the database
        $news = News::all();

        // Return the view with the News data
        return view('admin.news.index', compact('news'));
    }
}
