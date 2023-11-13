<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use App\Models\Post;



class ProfileController extends Controller
{
    public function profileupdate()
    {
        $user = User::find(auth()->id());
        return view('update-profile-photo', compact('user'));
    }
    public function edit(){
        $user = User::find(auth()->id());
        return view('editaboutme', compact('user'));
    }
    public function edit_aboutme(Request $request)
    {
        $aboutmeData = $request->validate([
            'aboutme' => 'required|max:2000',
        ]);
    
        $aboutmeData['aboutme'] = strip_tags($aboutmeData['aboutme']);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update the about_me field for the current user
        $user->update(['aboutme' => $aboutmeData['aboutme']]);

        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', ['posts' => $posts],['users' => $user]);
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function update_avatar(Request $request) {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
    
            // Use the Intervention Image package to manipulate and save the image
            $image = Image::make($avatar->getRealPath());
            $image->resize(300, 300);
            $image->save(public_path('images/' . $filename)); // Save the image to the public directory
    
            // Update the user's avatar in the database
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save(); // Save the updated user record
        }
    
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile', ['posts' => $posts],['users' => $user]);
    }

}
