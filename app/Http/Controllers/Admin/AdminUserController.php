<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDocuments;
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
    public function verifyDocuments(Request $request, $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Check if the user has documents in the UserDocuments table
        $userDocuments = UserDocuments::where('user_id', $id)->first();

        if ($userDocuments) {
            // Update user's mobile number from user documents' phone number
            $user->mobile_number = $userDocuments->phone_number;

            // If documents exist, verify the user
            $user->document_verified = true;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Documents verified successfully.',
            ]);
        } else {
            // If no documents found, return a failure response
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'No documents found for this user.',
                ],
                404,
            );
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('user_name', '!=', 'admin')->select(['id', 'user_name', 'email', 'mobile_number', 'document_verified', 'created_at']);
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    return Helper::Status($data);
                })
                ->addColumn('action', function ($user) {
                    $editLink = '';
                    $viewLink = URL::to('/') . '/admin/users/' . $user->id;

                    return Helper::Action($editLink, $user->id, $viewLink, $user->document_verified);

                    // return '<a href="#" class="btn btn-primary btn-sm">Edit</a>
                    //         <a href="#" class="btn btn-danger btn-sm">Delete</a>';
                })
                ->editColumn('mobile_number', function ($user) {
                    return $user->mobile_number ?: '-'; // Show '-' if mobile number is null or empty
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d-m-Y');
                })
                ->rawColumns(['status', 'action'])
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
        $userDocuments = UserDocuments::where('user_id', $id)->get();

        // Remove the base URL if present in profile
        $user->profile = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $user->profile);

        foreach ($userDocuments as $document) {
            $document->aadhar_front_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $document->aadhar_front_image);
            $document->aadhar_back_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $document->aadhar_back_image);
            $document->selfie_photo = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $document->selfie_photo);
            $document->pan_card_image = str_replace('https://tortoise-new-emu.ngrok-free.app/', '', $document->pan_card_image);
        }

        return view('admin.users.show', compact('user', 'userDocuments'));
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
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Check if user has documents before trying to delete
        if ($user->documents()->exists()) {
            // Delete related documents first
            $user->documents()->delete();
        }

        // Delete the user
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User and their documents deleted successfully.',
        ]);
    }
}
