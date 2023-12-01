<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Your login logic here

    if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = auth()->user();

        if ($user->is_admin == 1) {
            return redirect('admindashboard');
        } else {
            // Check if it's the user's first login
            if ($user->first_login) {
                // Redirect to change password page
                return redirect()->route('password.change');
            }

            // Redirect to regular dashboard
            return redirect()->route('dashboard');
        }
    } else {
        return redirect()->route('login')->with('status', 'Invalid login credentials');
    }
}
}
