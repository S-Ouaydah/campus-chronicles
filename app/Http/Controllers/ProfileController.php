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
   

    
    

}
