<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;



class ProfileController extends Controller
{

    public function view(){

        $episodes = Episode::getLikesByCurrentUser();
        $items = $episodes->all();
        $sortedEpisodes = $episodes->sortByDesc('created_at');
        $pfpPath = Auth::user()->fetchPfp();
        $userBio = Auth::user()->fetchBio();
        $showForm = false;
        


        

        return view('profile', [
            "episodes" => $episodes,
            "items" => $items,
            "sortedEpisodes" =>$sortedEpisodes,
            "pfpPath" => $pfpPath,
            "userBio" => $userBio,
            "showForm"=> $showForm,

           
        ]);

    
    }
    // public function updatePfp(Request $request)
    // {
    //     $request->validate([
    //         'pfp' => 'required|image|max:2048', // Adjust the validation rules as needed
    //     ]);

    //     // Get the uploaded file
    //     /** @var TemporaryUploadedFile $pfp */
    //     $pfp = $request->file('pfp');

    //     // Store the uploaded file and get its path
    //     $path = $pfp->store('public/profile_pictures');

    //     // Update the user's pfp_path in the database
    //     $user = Auth::user();
    //     $user->pfp_path = $path;
    //     $user->save();

    //     return redirect()->back()->with('success', 'Profile picture updated successfully!');
    // }

    
    

}
