<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Attempt to log the user in
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // If login is successful, redirect to the dashboard
                return redirect()->route('dashboard');
            } else {
                // If login fails, set an error message and redirect back
                session()->flash('error', trans('messages.invalidCredentials'));
                return redirect()->back()->withInput($request->only('email'));
            }
        } catch (\Throwable $th) {
            // Handle unexpected errors
            return redirect()
                ->back()
                ->withErrors(['error' => 'An error occurred while logging in.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the index route instead of login route
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
