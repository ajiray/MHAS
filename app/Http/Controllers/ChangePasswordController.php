<?php

// app/Http/Controllers/ChangePasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Change the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Update the 'first_login' flag
        $user->update([
            'first_login' => false,
        ]);

        // Redirect the user to the dashboard or wherever you want
        return redirect('/dashboard')->with('success', 'Password changed successfully!');
    }
}

