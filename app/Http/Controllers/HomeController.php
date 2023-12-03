<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Quote;
use App\Models\Comment;
use App\Models\Resource;
use App\Models\Appointment;
use App\Models\PendingUser;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\DB;
use App\Models\AcceptedAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
    $this->middleware('auth')->except(['contactUs']);
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
    return view('dashboard');
}   

    public function wall()
    {
        $comments = Comment::all();
        $posts = Post::all();
        
        return view('wall', ['posts' => $posts, 'comments' => $comments]);
    }   
    public function videocall() {

        // Get all notifications for the user
    $notifications = auth()->user()->notifications;

    // Get the count of unread notifications
    $unreadNotificationCount = DB::table('notifications')
        ->where('notifiable_id', auth()->id())
        ->where('notifiable_type', get_class(auth()->user()))
        ->whereNull('read_at')
        ->count();

    return view('videocallhomepage', [
        'notifications' => $notifications,
        'unreadNotificationCount' => $unreadNotificationCount,
    ]);
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
        $pendingUsers = PendingUser::all();
        return view('admindashboard', compact('pendingUsers'));
    }

    public function adminWall()
    {
        $posts = Post::all();
        return view('adminwall', ['posts' => $posts]);
    }

    public function adminappointment()
{
    $counselor = Auth::user();
    $appointments = Appointment::all()->sortBy(function ($appointment) {
        return $appointment->date . ' ' . $appointment->time;
    });

    $acceptedAppointments = AcceptedAppointment::where('counselor_id', $counselor->id)
    ->get()
    ->sortBy(function ($acceptedAppointment) {
        return $acceptedAppointment->appointment->date . '' . $acceptedAppointment->appointment->time;
    });

    $counselors = User::where('is_admin', 2)->get();

    return view('adminappointment', [
        'appointments' => $appointments,
        'acceptedAppointments' => $acceptedAppointments,
        'counselors' => $counselors,
    ]);
}

    public function adminmessage()
    {
        return view('adminmessage');
    }

    public function adminresources()
    {
        $resources = Resource::all();
        return view('adminresources', ['resources' => $resources]);
    }

    public function registerGuidance(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'userType' => 'required|integer', // Assuming userType is an integer
        ]);
    
        // Create a new user in the database
        $user = User::create([
            'name' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'is_admin' => $validatedData['userType'],
        ]);
    
        $pendingUsers = PendingUser::all();
        return view('admindashboard', compact('pendingUsers'))->with('success', 'User registered successfully!');
    }

    public function guidancedashboard() {
        return view('guidancedashboard');
    }

    public function guidanceappointment() {
        // Get the currently authenticated user (counselor)
        $counselor = Auth::user();
        
        $acceptedAppointments = AcceptedAppointment::where('counselor_id', $counselor->id)
        ->get()
        ->sortBy(function ($acceptedAppointment) {
            return $acceptedAppointment->appointment->date . '' . $acceptedAppointment->appointment->time;
        });
          
        // Retrieve all appointments where counselor_id matches the logged-in counselor's ID
        $appointments = Appointment::where('counselor_id', $counselor->id)->get();
    
        return view('guidanceappointment', ['appointments' => $appointments, 'acceptedAppointments' => $acceptedAppointments]);
    }

    public function guidancewall()
    {
        $posts = Post::all();
        return view('guidancewall', ['posts' => $posts]);
    }

    public function guidanceresources() {
        $resources = Resource::all();
        return view('guidanceresources', ['resources' => $resources]);
    }

    public function showCounselingRecordsForm(){
        return view('counseling-records');
    }

    public function contactUs(Request $request) {
        $data = $request->only(['name', 'email', 'message']);
    
        // Send email
        Mail::to('mindscapementalhealth331@gmail.com')->send(new ContactFormMail($data));
    
        // Redirect back to the contact section with a success message
        return Redirect::to('/#contact')->with('success', 'Email sent successfully!');
    }
}
