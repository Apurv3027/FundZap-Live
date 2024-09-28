<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('user_name', '!=', 'admin')->select(['id', 'user_name', 'email', 'mobile_number', 'created_at']);
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->editColumn('mobile_number', function ($user) {
                    return $user->mobile_number ?: '-';  // Show '-' if mobile number is null or empty
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d-m-Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }
}
