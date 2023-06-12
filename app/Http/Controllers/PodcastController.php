<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('podcast.create', [

        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:podcast_categories,id',
            'pod_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validating the image file
        ]);
    
        $currentuser = Auth::user();
    
        $formData = new Podcast();
        $formData->creator_id = $currentuser->id;
        $formData->title = $validatedData['title'];
        $formData->description = $validatedData['description'];
        $formData->category_id = $validatedData['category_id'];
    
        // Handling the image upload and storing the file path in the database
        if ($request->hasFile('pod_pic')) {
            $image = $request->file('pod_pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/podcast-pics', $filename); // Save the image in the storage directory
    
            $formData->image_url = 'storage/podcast-pics/' . $filename; // Save the image path in the database
        }
    
        if ($formData->save()) {
            return redirect('/dashboard')->with('success', 'Form submitted successfully!');
        }
    
        return redirect('/dashboard')->flash('error', 'An error has occurred!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $podcast = Podcast::findOrFail($id);

        return view('podcast.podcast', [
            'podcast' => $podcast,
            'episodes' => $podcast->getEpisodes(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Podcast $podcast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        //
    }

}