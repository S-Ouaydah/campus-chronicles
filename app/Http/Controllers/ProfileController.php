<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Listen;
use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\DB;

use PhpParser\Node\Expr\Cast\String_;

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
        $subscriptions = Subscriptions::getSubsByUser($user->id);
        $following = $user->following()->get();


        $historyTable = Listen::getHistoryByUser($user->id);
        $sortedHistory = $historyTable->sortByDesc('updated_at');





        return view('profile', [
            "episodes" => $episodes,
            "items" => $items,
            "sortedEpisodes" => $sortedEpisodes,
            "pfpPath" => $pfpPath,
            "userBio" => $userBio,
            "showForm" => $showForm,
            "user" => $user,
            "subscriptions" => $subscriptions,
            "historyTable" => $historyTable,
            "sortedHistory" => $sortedHistory,
            "following" => $following,



        ]);


    }

    public function profile_view(string $uid)
    {
        /** @var \App\Models\User $user */
        $user = User::findOrFail($uid);
        $podcasts = $user->podcasts;
        $pfpPath = $user->profile_pic();
        $userBio = $user->bio();
        $followerCount = DB::table('follows')
            ->where('creator_id', $uid)
            ->count();




        return view('public-profile', [
            "pfpPath" => $pfpPath,
            "userBio" => $userBio,
            "podcasts" => $podcasts,
            "user" => $user,
            "followerCount" => $followerCount ,



        ]);


    }





}