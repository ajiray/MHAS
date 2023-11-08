<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post) {
        
            $post->delete();
        
        return redirect('/dashboard')->with('delete', 'Success! Your post has been deleted');
    }
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'body' => 'required|max:200'
        ]); 

        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/dashboard')->with('success', 'Success! Your post has been published');
    }

    public function deletePostAdmin(Post $post) {
        
        $post->delete();
    
    return redirect('/admindashboard')->with('delete', 'Success! The post has been deleted');
}

public function heartReact(Post $post) {
    $user = auth()->user();

    // Check if the user has already reacted to this post
    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'heart')->first();

    if ($existingReaction) {
        // The user has already reacted, so remove the reaction
        $existingReaction->delete();
    } else {
        // The user hasn't reacted, so add a heart reaction
        $post->reactions()->create([
            'type' => 'heart',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function thumbReact(Post $post) {
    $user = auth()->user();

    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'like')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'like',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function hahaReact(Post $post) {
    $user = auth()->user();


    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'haha')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'haha',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}

public function sadReact(Post $post) {
    $user = auth()->user();


    $existingReaction = $post->reactions()->where('user_id', $user->id)->where('type', 'sad')->first();

    if ($existingReaction) {
       
        $existingReaction->delete();
    } else {
     
        $post->reactions()->create([
            'type' => 'sad',
            'user_id' => $user->id,
        ]);
    }

    return redirect()->back();
}


}
