<?php

use App\Models\Post;
use App\Models\User;
use App\Livewire\Counter;
use App\Models\Appointment;
use App\Events\ReactionAdded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\resourceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CounselingRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::post('/mark-notifications-as-read', [NotificationController::class, 'markNotificationsAsRead']);
Route::post('send',[ChatBotController::class,'sendChat']);

//student side
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/appointment', [HomeController::class, 'appointment']);
Route::get('/message', function () {
    return redirect('http://127.0.0.1:8000/chatify');
})->name('message.redirect');
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/chatbot', [HomeController::class, 'chatbot']);
Route::get('/resources', [HomeController::class, 'resources']);
Route::get('/wall', [HomeController::class, 'wall']);
Route::get('/messageOption', [HomeController::class, 'messageOption']);
 
//admin side
Route::get('/admindashboard', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admindashboard')->middleware('is_admin');
Route::get('/adminappointment', [HomeController::class, 'adminappointment']);
Route::get('/adminmessage', function () {
    return redirect('http://127.0.0.1:8000/chatify');
})->name('message.redirect');
Route::get('/adminresources', [HomeController::class, 'adminresources']);
Route::get('/adminwall', [HomeController::class, 'adminWall']);
Route::post('/registerGuidance', [HomeController::class, 'registerGuidance']);

//counselor side
Route::get('/guidancedashboard', [HomeController::class, 'guidancedashboard'])->name('guidancedashboard');
Route::get('/guidanceappointment', [HomeController::class, 'guidanceappointment']);
Route::get('/guidancewall', [HomeController::class, 'guidancewall']);
Route::get('/guidanceresources', [HomeController::class, 'guidanceresources']);




//blog post
Route::post('/create-post', [PostController::class, 'createPost']);
Route::post('/create-post-admin', [PostController::class, 'createPostAdmin']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
Route::delete('/delete-post-admin/{post}', [PostController::class, 'deletePostAdmin']);
Route::post('/heartReact/{post}', [PostController::class, 'heartReact'])->name('heartReact');
Route::post('/likeReact/{post}', [PostController::class, 'likeReact'])->name('likeReact');
Route::post('/hahaReact/{post}', [PostController::class, 'hahaReact'])->name('hahaReact');
Route::post('/sadReact/{post}', [PostController::class, 'sadReact'])->name('sadReact');
Route::get('/reaction-count/{post}/{reactionType}', [PostController::class, 'getReactionCount']);
Route::post('/submitComment/{post}', [PostController::class, 'submitComment']);
Route::get('/comments/{postId}', [PostController::class, 'getComments']);
Route::delete('/delete-comment/{comment}', [PostController::class, 'deleteComment']);
Route::get('/comment-count/{postId}', [PostController::class, 'getCommentCount']);
Route::delete('/delete-post-profile/{post}', [PostController::class, 'deletePostProfile']);



//appointment
Route::post('/contactCounselor/{appointment}', [AppointmentController::class, 'contactCounselor']);
Route::post('/book-appointment', [AppointmentController::class, 'bookAppointment']);
Route::delete('/cancel-appointment/{appointment}', [AppointmentController::class, 'cancelAppointment']);
Route::delete('/understand-appointment/{appointment}', [AppointmentController::class, 'understandAppointment']);
Route::patch('/accept-appointment/{appointment}', [AppointmentController::class, 'acceptAppointment']);
Route::patch('/decline-appointment/{appointment}', [AppointmentController::class, 'declineAppointment']);
Route::delete('/markAsDone/{appointment}', [AppointmentController::class, 'markAsDone'])->name('markAsDone');
Route::patch('/assign-counselor/{appointment}', [AppointmentController::class, 'assignCounselor']);
Route::delete('/resched/{acceptedAppointment}', [AppointmentController::class, 'resched']);


//resources
Route::post('/store-resource', [resourceController::class, 'storeResource'])->name('store-resource');
Route::get('/getResources', [resourceController::class, 'getResources']);
Route::delete('/delete-resource/{resource}',[resourceController::class, 'deleteResource']);


// Update Profile
Route::get('/update-profile-photo', [ProfileController::class, 'profileupdate'])->name('profile');
Route::get('/update_avatar', [ProfileController::class, 'update_avatar'])->name('update_avatar');
Route::post('/update_profile', [ProfileController::class, 'update_avatar'])->name('update_profile');
Route::get('/editaboutme',[ProfileController::class,'edit'])->name('edit');
Route::post('/update_aboutme',[ProfileController::class,'edit_aboutme'])->name('edit_aboutme');


//Reset Password
Route::get('/forget-password',[ForgetPasswordManager::class,'forgetPassword'])->name('forget.password');
Route::post('/forget-password',[ForgetPasswordManager::class,'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}',[ForgetPasswordManager::class,'resetPassword'])->name('reset.Password');
Route::post('/reset-password',[ForgetPasswordManager::class,'resetPasswordPost'])->name('resetPasswordPost');

//Video Call
Route::get('/videocall', [HomeController::class, 'videocall']);
Route::post("/createMeeting", [MeetingController::class, 'createMeeting'])->name("createMeeting");
Route::post("/validateMeeting", [MeetingController::class, 'validateMeeting'])->name("validateMeeting");
Route::get("/leftmeeting", [MeetingController::class, 'leftmeeting'])->name("leftmeeting");
Route::get("/meeting/{meetingId}", function($meetingId) {

    $METERED_DOMAIN = env('METERED_DOMAIN');
    return view('meeting', [
        'METERED_DOMAIN' => $METERED_DOMAIN,
        'MEETING_ID' => $meetingId
    ]);
});


//Admin Pending Registrations
Route::get('/acceptregisters', [AdminController::class, 'showPendingRegistrations']);
Route::post('/admin/approve-user/{id}', [AdminController::class, 'approveUsers'])->name('admin.approve-user');
Route::post('/admin/decline-user/{id}', [AdminController::class, 'declineUser'])->name('admin.decline-user');


//First Login 
Route::get('/password/change', [ChangePasswordController:: class, 'showChangeForm'])->name('password.change');
Route::post('/password/change', [ChangePasswordController::class,'changePassword']);


//Counseling Records
Route::get('/counselingrecords',[HomeController:: class, 'showCounselingRecordsForm']);
Route::post('/counseling-records/search', [CounselingRecordController::class, 'search'])->name('counseling-records.search');
Route::post('/counseling-records.back', [CounselingRecordController::class, 'search'])->name('counseling-records.back');
Route::get('/counseling-records/create', [CounselingRecordController::class, 'create'])->name('counseling-records.create');
Route::get('/errorcode',[CounselingRecordController::class,'error'])->name('errorcode');
Route::get('/main-screen',[CounselingRecordController::class,'mainScreen'])->name('main-screen');


//Contact Us
Route::post('/contactUs', [HomeController::class, 'contactUs']);

