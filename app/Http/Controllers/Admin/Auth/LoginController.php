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
        return redirect()->route('dashboard');
        dd($request->toArray());
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Attempt to log the user in
            // if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if ($request->email == 'admin@gmail.com' && $request->password == '12345') {
                // If login is successful, redirect to the dashboard
                return redirect()->intended(route('dashboard'));
            }

            // If login fails, return with an error message
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout()
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
