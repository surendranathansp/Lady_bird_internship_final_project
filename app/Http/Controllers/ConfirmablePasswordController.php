<?php

// ConfirmablePasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmablePasswordController extends Controller
{
    public function show(Request $request): View
    {
        return view('auth.confirm-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, $request->user()->password)) {
            $request->session()->passwordConfirmed();

            return redirect()->intended(); // Redirect to the intended URL after confirmation
        }

        return back()->withErrors(['password' => 'Invalid password']);
    }
}

