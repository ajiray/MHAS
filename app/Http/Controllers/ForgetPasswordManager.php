<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgetPasswordManager extends Controller
{
    function forgetPassword(){
        return view('reset');
    }

    function forgetPasswordPost(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Set the MAIL_USERNAME dynamically to the user's email
        config(['mail.from.address' => $request->input('email')]);
        config(['mail.username' => $request->input('email')]);

        Mail::send('emails.forget-password', ['token' => $token], function($message) use ($request) {
            $message->to($request->input('email'));
            $message->subject('Reset Password');
        });

        // Reset the MAIL_USERNAME to null after sending the email
        config(['mail.from.address' => null]);
        config(['mail.username' => null]);

        return redirect()->route('forget.password')->with('success', 'We have sent an email to reset your password.');
    }

    function resetPassword($token){
        $resetRecord = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetRecord) {
            return redirect()->route('forget.password')->with('error', 'Invalid token');
        }

        return view('new-password', compact('token'));
    }

    function resetPasswordPost(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $resetRecord = DB::table('password_resets')
            ->where([
                'email' => $request->input('email'),
                'token' => $request->token
            ])->first();

        if (!$resetRecord) {
            return redirect()->route('reset.Password')->with('error', 'Invalid email or token');
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->route('reset.Password')->with('error', 'Invalid email address');
        }

        // Update the user's password
        $user->update(['password' => Hash::make($request->password)]);

        // Delete the password reset record
        DB::table('password_resets')->where(['email' => $request->input('email')])->delete();

        return redirect()->route('login')->with('success', 'Your Password has been reset successfully.');
    }
}

