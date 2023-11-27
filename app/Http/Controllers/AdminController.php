<?php

namespace App\Http\Controllers;
use App\Mail\RegistrationStatusMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\PendingUser;

class AdminController extends Controller
{
    public function showPendingRegistrations()
    {
        $pendingUsers = PendingUser::all();

        return view('adminpending_registrations', compact('pendingUsers'));
    }

    public function approveUsers($id)
    {
        $pendingUser = PendingUser::find($id);

        // Create user in 'users' table
        $user = User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password,
            'status' => 'approved',
        ]);

        // Send confirmation email to the user
        $this->sendStatusEmail($user, 'approved');

        // Optionally, you can delete the pending user record
        $pendingUser->delete();

        return redirect()->route('listregisters')->with('success', 'User approved successfully.');
    }

    public function declineUser($id)
    {
        $pendingUser = PendingUser::find($id);

        // Send decline email to the user
        $this->sendStatusEmail($pendingUser, 'declined');

        // Delete the pending user record
        $pendingUser->delete();

        return redirect()->route('listregisters')->with('success', 'User declined successfully.');
    }

    private function sendStatusEmail($user, $status)
    {
        // Send email to the user with the registration status
        Mail::to($user->email)->send(new RegistrationStatusMail($user, $status));
    }

}
