<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfileController extends Controller
{

    public function view(){

        $episodes = Episode::getLikesByCurrentUser();
        $items = $episodes->all();
        $sortedEpisodes = $episodes->sortByDesc('created_at');



        

        return view('profile', [
            "episodes" => $episodes,
            "items" => $items,
            "sortedEpisodes" =>$sortedEpisodes,
           
        ]);



    }
    

}
