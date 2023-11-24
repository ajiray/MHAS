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
            'file_content' => 'nullable|file|mimes:pdf,epub,mobi|max:10240',
            'file_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category' => 'required|in:pdf,infographic,ebook,video',
            'youtube_link' => 'nullable|url',
            'infographic' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'ebook' => 'nullable|file|mimes:pdf,epub,mobi|max:10240',
        ]);
    
        // Create a new Resource record in the database
        $resource = new Resource();
        $resource->title = $validatedData['title'];
        $resource->description = $validatedData['description'];
        $resource->category = $validatedData['category'];
    
        // Conditionally handle the file uploads based on the category
        if ($validatedData['category'] === 'pdf') {
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
    
                $resource->file_content = $fileName; // Store the file path in the database
                $resource->file_cover = $coverPhotoName; // Store the cover photo path in the database
            } else {
                return redirect('/adminresources')->with('error', 'File upload failed');
            }
        } elseif ($validatedData['category'] === 'infographic') { 
            // Handle infographic file upload
            if ($request->hasFile('infographic')) {
                $infographic = $request->file('infographic');
                
                $infographicName = $infographic->getClientOriginalName();
                $infographic->storeAs('resources', $infographicName, 'public');
    
                $resource->file_content = $infographicName;
            } else {
                return redirect('/adminresources')->with('error', 'File upload failed');
            }
        } elseif ($validatedData['category'] === 'ebook') {
            // Handle ebook file upload
            if ($request->hasFile('ebook')) {
                $ebook = $request->file('ebook');
                $coverPhoto = $request->file('file_cover');
                
                $ebookName = $ebook->getClientOriginalName();
                $ebook->storeAs('resources', $ebookName, 'public');
                $coverPhotoName = $coverPhoto->getClientOriginalName();
                $coverPhoto->storeAs('covers', $coverPhotoName, 'public');
    
                $resource->file_content = $ebookName;
                $resource->file_cover = $coverPhotoName;
            } else {
                return redirect('/adminresources')->with('error', 'File upload failed');
            }
        }
    
        // Continue handling other categories (video, etc.)...
    
        if ($validatedData['category'] === 'video' && $validatedData['youtube_link']) {
            // Check if it's a valid YouTube URL
            if (parse_url($validatedData['youtube_link'], PHP_URL_HOST) === 'www.youtube.com') {
                $resource->youtube_link = $validatedData['youtube_link']; // Store the YouTube link
            } else {
                return redirect('/adminresources')->with('error', 'Invalid YouTube link');
            }
        }
    
        $resource->save();
    
        return redirect('/adminresources')->with('success', 'Resource uploaded successfully');
    }
    



public function getResources(Request $request)
{
    $categories = $request->input('categories');
    if ($categories) {
        $resources = Resource::whereIn('category', $categories)->get();
    } else {
        $resources = Resource::all();
    }

    return response()->json($resources);
}


}
