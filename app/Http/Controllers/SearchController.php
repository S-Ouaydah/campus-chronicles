<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function view(Request $request)
    {
        $searchTerm = $request->input('search');

        $currentuser = Auth::user();
        
        // Perform the search across Podcasts, Episodes, and Accounts
        $podcasts = Podcast::where('title', 'like', '%'.$searchTerm.'%')->get();
        $episodes = Episode::where('title', 'like', '%'.$searchTerm.'%')->get();
        $users = User::where('name', 'like', '%'.$searchTerm.'%')->get();

        return view('search-results', [
            'searchTerm' => $searchTerm,
            'podcasts' => $podcasts,
            'episodes' => $episodes,
            'users' => $users,
            'currentuser' => $currentuser
        ]);
    }

}
