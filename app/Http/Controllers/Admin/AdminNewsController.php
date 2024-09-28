<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Yajra\DataTables\Facades\DataTables;

class AdminNewsController extends Controller
{
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
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['url', 'date', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.news.index');
    }
}
