<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('user_name', '!=', 'admin')->select(['id', 'user_name', 'email', 'mobile_number', 'created_at']);
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {

                    $editLink = '';
                    $viewLink = URL::to('/') . '/admin/users/' . $user->id;

                    return Helper::Action($editLink, $user->id, $viewLink);

                    // return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                    //         <a href="#" class="btn btn-danger btn-sm">Delete</a>';
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Remove the base URL if present in profile
        $user->profile = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $user->profile);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
