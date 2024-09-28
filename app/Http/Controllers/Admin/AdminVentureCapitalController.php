<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VentureCapital;
use Yajra\DataTables\Facades\DataTables;

class AdminVentureCapitalController extends Controller
{
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
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['vc_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.venture-capital.index');
    }
}
