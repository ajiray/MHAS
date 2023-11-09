<?php

use App\Models\Post;
use App\Livewire\Counter;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\resourceController;
use App\Http\Controllers\AppointmentController;

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
Route::get('/message', [HomeController::class, 'message']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/resources', [HomeController::class, 'resources']);
 
//admin side
Route::get('/admindashboard', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admindashboard')->middleware('is_admin');
Route::get('/adminappointment', [HomeController::class, 'adminappointment']);
Route::get('/adminmessage', [HomeController::class, 'adminmessage']);
Route::get('/adminresources', [HomeController::class, 'adminresources']);




//blog post
Route::post('/create-post', [PostController::class, 'createPost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);
Route::delete('/delete-post-admin/{post}', [PostController::class, 'deletePostAdmin']);
Route::post('/heartReact/{post}', [PostController::class, 'heartReact'])->name('heartReact');
Route::post('/thumbReact/{post}', [PostController::class, 'thumbReact'])->name('thumbReact');
Route::post('/hahaReact/{post}', [PostController::class, 'hahaReact'])->name('hahaReact');
Route::post('/sadReact/{post}', [PostController::class, 'sadReact'])->name('sadReact');



//appointment
Route::post('/book-appointment', [AppointmentController::class, 'bookAppointment']);
Route::delete('/cancel-appointment/{appointment}', [AppointmentController::class, 'cancelAppointment']);
Route::delete('/understand-appointment/{appointment}', [AppointmentController::class, 'understandAppointment']);
Route::patch('/accept-appointment/{appointment}', [AppointmentController::class, 'acceptAppointment']);
Route::patch('/decline-appointment/{appointment}', [AppointmentController::class, 'declineAppointment']);
Route::delete('/markAsDone/{appointment}', [AppointmentController::class, 'markAsDone'])->name('markAsDone');

//resources
Route::post('/store-resource', [resourceController::class, 'storeResource']);





