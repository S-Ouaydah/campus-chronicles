<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\PodcastCategory;
use App\Models\Episode;
use App\Models\Listen;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;


class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  public function view(){

    //     $user = Auth::user(); 
    //     $lastNewEpisodes = Episode::orderBy('created_at', 'desc')
    //         ->limit(1)
    //         ->get();



    //     return view('explore', [

    //         "user" => $user,
    //         "lastNewEpisodes" => $lastNewEpisodes,


    //     ]);

    //  }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = PodcastCategory::all();

        $lastNewEpisodes = Episode::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $lastWeek = Carbon::now()->subWeek();

        $trendingEps = Episode::select('episodes.*', 'listen_counts.listen_count')
        ->leftJoinSub(
            function ($query) use ($lastWeek) {
                $query->select('episode_id', DB::raw('COUNT(*) as listen_count'))
                    ->from('listens')
                    ->where('created_at', '>', $lastWeek)
                    ->groupBy('episode_id');
            },
            'listen_counts',
            'episodes.id',
            '=',
            'listen_counts.episode_id'
        )
        ->where('listen_counts.listen_count', '>', 0) // Exclude episodes with zero listens
        ->orderByDesc('listen_counts.listen_count')
        ->limit(5)
        ->get();


        return view('explore', [
            'categories' => $categories,
            "lastNewEpisodes" => $lastNewEpisodes,
            "trendingEps" => $trendingEps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}