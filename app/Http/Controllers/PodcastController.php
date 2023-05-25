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
        ]);
        $currentuser = Auth::user();

        $formData = new Podcast();
        $formData->creator_id = $currentuser->id;
        $formData->title = $validatedData['title'];
        $formData->description = $validatedData['description'];
        $formData->category_id = $validatedData['category_id'];

        if ($formData->save()) {
            return redirect('/dashboard')->with('success', 'Form submitted successfully!');
        }
        return redirect('/dashboard')->flash('error', 'an error has occured!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        //
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
