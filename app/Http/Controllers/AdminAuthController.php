<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    // Show admin login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Admin login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard');
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    // Show admin reset password form
    public function showResetForm()
    {
        return view('admin.auth.reset');
    }

    // Admin reset password
    public function resetPassword(Request $request)
    {
        // Add your custom reset password logic here
    }

    // Show admin forgot password form
    public function showForgotForm()
    {
        return view('auth.forgot'); // Change the view to the general forgot password view
    }

    // Admin forgot password
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
