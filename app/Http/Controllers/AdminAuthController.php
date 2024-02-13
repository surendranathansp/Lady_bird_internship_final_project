<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ], [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Login successful'], 200);
            } else {
                return response()->json(['success' => true, 'message' => 'Already Loged in.'], 200);
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => trans('auth.failed')], 401);
        } else {
            // If it's a traditional form submission, throw a ValidationException with the error message
            throw ValidationException::withMessages([
                'success' => false,
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    // Show admin reset password form
    public function showResetForm()
    {
        return view('admin.auth.reset');
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
