<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource; // Make sure to import the Resource model

class ResourceController extends Controller // Correct the capitalization of your class name
{
    public function storeResource(Request $request) {
        // Validate the form input
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'publication_date' => 'required',
            'file_path' => 'required|file|mimes:mp4,avi,mov,mkv,wmv,flv,jpeg,jpg,png,gif,svg,pdf,epub,mobi',
            'category' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('resources', $fileName, 'public'); // Store the file in the 'resources' directory

            // Create a new Resource record in the database
            $resource = new Resource();
            $resource->title = $validatedData['title'];
            $resource->description = $validatedData['description'];
            $resource->author = $validatedData['author'];
            $resource->publication_date = $validatedData['publication_date'];
            $resource->file_path = $fileName; // Store the file name in the database
            $resource->category = $validatedData['category'];
            $resource->save();

            return redirect('/adminresources')->with('success', 'Resource uploaded successfully');
        } else {
            return redirect('/adminresources')->with('error', 'File upload failed');
        }
    }
}
