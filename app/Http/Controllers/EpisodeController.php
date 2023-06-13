<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'podcast_id' => 'required|exists:podcasts,id',
        ]);
        $currentuser = Auth::user();
        $formData = new Episode();
        
        $formData->creator_id = $currentuser->id;
        $formData->title = $validatedData['title'];
        $formData->description = $validatedData['description'];
        $formData->podcast_id = $validatedData['podcast_id'];
        
        $epcount = Podcast::find($formData->podcast_id)->episodes->count() + 1;
        $filename = $validatedData['podcast_id'] . "_" . $epcount;
        // get sequence from podcast_id nb of episodes
        $formData->sequence = $epcount;


        $formData->audio_path = "storage/audio_paths/" . $filename;


        // Get the file object
        $file = $request->file('audio_file');

        // Save the file to storage with a specific filename
        
        if (!Storage::putFileAs('public/audio_paths', $file, $filename.'.mp3')) {
            //err handling
        }

        if ($formData->save()) {
            return redirect('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
