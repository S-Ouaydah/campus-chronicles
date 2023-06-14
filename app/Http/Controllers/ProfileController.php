<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Subscriptions;


class ProfileController extends Controller
{

  
    public function view()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // TODO switch to using likes() relation in user model
        $episodes = Episode::getLikesByCurrentUser();
        $items = $episodes->all();
        $sortedEpisodes = $episodes->sortByDesc('created_at');
        $pfpPath = $user->profile_pic();
        $userBio = $user->bio();
        $showForm = false;
        $user = Auth::user();
        $subscriptions = Subscriptions::getSubsByUser($user->id);





        return view('profile', [
            "episodes" => $episodes,
            "items" => $items,
            "sortedEpisodes" => $sortedEpisodes,
            "pfpPath" => $pfpPath,
            "userBio" => $userBio,
            "showForm" => $showForm,
            "user" => $user,
            "subscriptions" => $subscriptions,
            


        ]);


    }





}