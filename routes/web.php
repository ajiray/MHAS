<?php

use App\Models\Post;
use App\Livewire\Counter;
use App\Models\Appointment;
use App\Events\ReactionAdded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\resourceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;

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


//student side
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/appointment', [HomeController::class, 'appointment']);
Route::get('/message', function () {
    return redirect('http://127.0.0.1:8000/chatify');
})->name('message.redirect');
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/resources', [HomeController::class, 'resources']);
 
//admin side
Route::get('/admindashboard', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admindashboard')->middleware('is_admin');
Route::get('/adminappointment', [HomeController::class, 'adminappointment']);
Route::get('/adminmessage', function () {
    return redirect('http://127.0.0.1:8000/chatify');
})->name('message.redirect');
Route::get('/adminresources', [HomeController::class, 'adminresources']);




//blog post
Route::post('/create-post', [PostController::class, 'createPost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
Route::delete('/delete-post-admin/{post}', [PostController::class, 'deletePostAdmin']);
Route::post('/heartReact/{post}', [PostController::class, 'heartReact'])->name('heartReact');
Route::post('/likeReact/{post}', [PostController::class, 'likeReact'])->name('likeReact');
Route::post('/hahaReact/{post}', [PostController::class, 'hahaReact'])->name('hahaReact');
Route::post('/sadReact/{post}', [PostController::class, 'sadReact'])->name('sadReact');
Route::get('/reaction-count/{post}/{reactionType}', [PostController::class, 'getReactionCount']);
Route::post('/submitComment/{post}', [PostController::class, 'submitComment']);
Route::delete('/delete-comment/{comment}', [PostController::class, 'deleteComment']);


//appointment
Route::post('/book-appointment', [AppointmentController::class, 'bookAppointment']);
Route::delete('/cancel-appointment/{appointment}', [AppointmentController::class, 'cancelAppointment']);
Route::delete('/understand-appointment/{appointment}', [AppointmentController::class, 'understandAppointment']);
Route::patch('/accept-appointment/{appointment}', [AppointmentController::class, 'acceptAppointment']);
Route::patch('/decline-appointment/{appointment}', [AppointmentController::class, 'declineAppointment']);
Route::delete('/markAsDone/{appointment}', [AppointmentController::class, 'markAsDone'])->name('markAsDone');

//resources
Route::post('/store-resource', [resourceController::class, 'storeResource'])->name('store-resource');
Route::get('/resources', [ResourceController::class, 'showResources']);
Route::get('/resources/{id}/download', [ResourceController::class, 'download'])->name('download');



// Update Profile
Route::get('/update-profile-photo', [ProfileController::class, 'profileupdate'])->name('profile');
Route::get('/update_avatar', [ProfileController::class, 'update_avatar'])->name('update_avatar');
Route::post('/update_profile', [ProfileController::class, 'update_avatar'])->name('update_profile');
Route::get('/editaboutme',[ProfileController::class,'edit'])->name('edit');
Route::post('/update_aboutme',[ProfileController::class,'edit_aboutme'])->name('edit_aboutme');



