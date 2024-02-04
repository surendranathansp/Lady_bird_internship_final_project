<?php
// VerifyEmailController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect('/'); // Or your desired redirect path
        }

        if ($user->email_verified_at === null || ! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/'); // Or handle the invalid verification link
        }

        $user->markEmailAsVerified();

        return redirect('/')->with('verified', true);
    }
}
