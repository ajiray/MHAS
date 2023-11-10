<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource; // Make sure to import the Resource model

class ResourceController extends Controller // Correct the capitalization of your class name
{
    public function storeResource(Request $request)
{
    // Validate the form input
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'author' => 'required',
        'file_content' => 'required|file|mimes:mp4,avi,mov,mkv,wmv,flv,jpeg,jpg,png,gif,svg,pdf,epub,mobi,docx',
        'file_cover' => 'required|image|mimes:jpeg,png,jpg,gif',
        'category' => 'required',
    ]);

    // Handle file uploads
    if ($request->hasFile('file_content') && $request->hasFile('file_cover')) {
        $file = $request->file('file_content');
        $coverPhoto = $request->file('file_cover');

       // Handle resource file upload
        $fileName = $file->getClientOriginalName();
        $file->storeAs('resources', $fileName, 'public');

        // Handle cover photo upload
        $coverPhotoName = $coverPhoto->getClientOriginalName();
        $coverPhoto->storeAs('covers', $coverPhotoName, 'public');


        // Create a new Resource record in the database
        $resource = new Resource();
        $resource->title = $validatedData['title'];
        $resource->description = $validatedData['description'];
        $resource->author = $validatedData['author'];
        $resource->file_content = $fileName; // Store the file path in the database
        $resource->file_cover = $coverPhotoName; // Store the cover photo path in the database
        $resource->category = $validatedData['category'];
        $resource->save();

        return redirect('/adminresources')->with('success', 'Resource uploaded successfully');
    } else {
        return redirect('/adminresources')->with('error', 'File upload failed');
    }
}


    public function showResources() {
        $resources = Resource::all();
        return view('/resources',['resources' => $resources]);
    }




}
