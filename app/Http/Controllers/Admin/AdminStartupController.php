<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use Yajra\DataTables\Facades\DataTables;

class AdminStartupController extends Controller
{
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
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['startup_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.startups.index');
    }
}
