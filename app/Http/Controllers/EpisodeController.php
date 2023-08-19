<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use getID3\getID3;
use Carbon\Carbon;

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
    public function create($validatedData)
    {
        $currentUser = Auth::user();

        $epcount = Podcast::find($validatedData['podcast_id'])->episodes->count() + 1;
        $filename = $validatedData['podcast_id'] . "_" . $epcount;

        $episode = new Episode([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'podcast_id' => $validatedData['podcast_id'],
            'sequence' => $epcount,
            'audio_path' => "storage/audio_paths/" . $filename,
            'creator_id' => $currentUser->id,
        ]);

        return $episode;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => ['required',Rule::unique('episodes')->where(function ($query) use ($request) {
                    return $query->where('podcast_id', $request->input('podcast_id'));
                })],
                'description' => 'required',
                'podcast_id' => 'required|exists:podcasts,id',
                'audio_file' => 'required|file|mimetypes:audio/mpeg',
            ],[
                'title.unique' => ' Episode title must be unique in a podcast!',
                'podcast_id.exists' => ' Podcast does not exist!',
                'audio_file.mimetypes' => ' Audio file must be in mp3 format!',
            ]);
            $file = $request->file('audio_file');
            $epcount = Podcast::find($validatedData['podcast_id'])->episodes->count() + 1;
            $filename = $validatedData['podcast_id'] . "_" . $epcount;

            $episode = $this->create($validatedData);

            $file = $request->file('audio_file');
            $filename = "{$episode->podcast_id}_{$episode->sequence}";
            $episode->audio_length = $this->getDuration($file);

            if (Storage::putFileAs('public/audio_paths', $file, $filename.'.mp3')) {
                if (!$episode->save()) {
                    flash()->addError('An error occurred while saving the episode!');
                } else {
                    flash()->addSuccess('Episode created successfully!');
                }
            } else {
                flash()->addError('An error occurred during file saving!');
            }
        } catch (ValidationException $e) {
            flash()->addError($e->getMessage());
        }

        return redirect('/dashboard');
    }

    public function getDuration($audioPath){
        $getID3 = new \getID3();
        $fileInfo = $getID3->analyze($audioPath);
        if (isset($fileInfo['playtime_seconds'])) {
            return $fileInfo['playtime_seconds'];
        }
        return null;
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

        $audioPath = "public/audio_paths/" . basename($episode->audio_path) . ".mp3";
        $pod_id = $episode->podcast_id;

        // Delete the episode
        if ($episode->delete()) {
            // Delete episode audio
            Storage::delete($audioPath);

            return redirect('/podcast/'. $pod_id)->with('success', 'episode deleted successfully!');
        }

        return redirect('/podcast/'. $pod_id)->with('error', 'An error has occured!');
    }
}
