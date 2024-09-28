<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Yajra\DataTables\Facades\DataTables;

class AdminPortfolioController extends Controller
{
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
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->rawColumns(['venture_capital_id', 'pf_startup_url', 'action'])
                ->make(true);
        }

        // Return the view with the News data
        return view('admin.portfolio.index');
    }
}
