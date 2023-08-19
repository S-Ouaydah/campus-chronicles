<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


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
    public function create(array $validatedData)
    {
        $currentuser = Auth::user();

        $podcast = new Podcast([
            'creator_id' => $currentuser->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
        ]);

        if (isset($validatedData['pod_pic'])) {
            $image = $validatedData['pod_pic'];
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/podcast-pics', $filename);

            $podcast->image_url = 'storage/podcast-pics/' . $filename;
        }

        return $podcast;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => [
                    'required', 'max:255',
                    Rule::unique('podcasts')->where(function ($query) {
                        return $query->where('creator_id', Auth::id());
                    }),
                ],
                'description' => 'required',
                'category_id' => 'required|exists:podcast_categories,id',
                'pod_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validating the image file
            ], [
                'title.unique' => 'You already have a podcast with this title!',
                'category_id.exists' => ' Category does not exist!',
                'pod_pic.mimes' => 'Unsupported image format!',
            ]);

            $podcast = $this->create($validatedData);

            if ($podcast->save()) {
                flash()->addSuccess('Podcast created successfully!');
            } else {
                flash()->addError('An error has occurred!');
            }
        } catch (ValidationException $e) {
            flash()->addError($e->getMessage());
        }

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
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
        $image_url = $podcast->image_url;
        $audioPaths = [];

        foreach ($podcast->episodes as $episode) {
            $audioPaths[] = "public/audio_paths/" . basename($episode->audio_path) . ".mp3";
        }

        // Delete the podcast
        if ($podcast->delete()) {
            // Delete podcast image from storage
            Storage::delete("public/podcast-pics/" . basename($image_url));
            // Delete episodes audios
            foreach ($audioPaths as $audioPath) {
                Storage::delete($audioPath);
            }

            return redirect('/dashboard')->with('success', 'Podcast and its episodes deleted successfully!');
        }

        return redirect('/dashboard')->with('error', 'An error has occured!');
    }
}
