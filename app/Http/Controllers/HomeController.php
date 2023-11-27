<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Quote;
use App\Models\Comment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AcceptedAppointment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $quote = $request->session()->get('quote');

        // If not, fetch a new random quote and store it in the session
        if (!$quote) {
            $quote = Quote::inRandomOrder()->first();
            $request->session()->put('quote', $quote);
        }
        return view('dashboard', compact('quote'));
    }    

    public function wall()
    {
        $comments = Comment::all();
        $posts = Post::all();
        
        return view('wall', ['posts' => $posts, 'comments' => $comments]);
    }   
    public function videocall() {
        return view('videocallhomepage');
    }
    

    public function message() {
        return view('message');
    }

    public function chatbot() {
        return view('chatbotMain');
    }

    public function messageOption() {
        return view('messageOption');
    }

    public function appointment() {
        $appointments = Appointment::all()->sortBy(function ($appointment) {
            return $appointment->date . ' ' . $appointment->time;
        });
    
        return view('appointment', ['appointments' => $appointments]);
    }
    

    public function profile() {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', ['posts' => $posts],['users' => $user]);
    }

    public function resources() {
        return view('resources');
    }


    
    public function adminHome()
    {
        return view('admindashboard');
    }

    public function adminWall()
    {
        $posts = Post::all();
        return view('adminwall', ['posts' => $posts]);
    }

    public function adminappointment()
{
    // Get all appointments and sort them by 'date' and 'time'
    $appointments = Appointment::all()->sortBy(function ($appointment) {
        return $appointment->date . ' ' . $appointment->time;
    });

    // Get all accepted appointments
    $acceptedAppointments = AcceptedAppointment::all()->sortBy(function ($acceptedAppointment){
        return $acceptedAppointment->appointment->date . '' . $acceptedAppointment->appointment->time;
    });

    return view('adminappointment', [
        'appointments' => $appointments,
        'acceptedAppointments' => $acceptedAppointments,
    ]);
}

    

    public function adminmessage()
    {
        return view('adminmessage');
    }

    public function adminresources()
    {
        return view('adminresources');
    }
}
