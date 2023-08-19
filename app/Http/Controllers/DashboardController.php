<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Podcast;
use App\Models\PodcastCategory;
use App\Models\Listen;
use Carbon\Carbon;

class DashboardController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {


        $categories = PodcastCategory::all();
        $podcasts = Podcast::where('creator_id', Auth::user()->id)
            ->orderBy('created_at', 'desc') // Order by 'created_at' column in descending order
            ->get();
        $podcastIds = Podcast::where('creator_id', auth()->id())->pluck('id');
        $countPods = $podcasts->count();

        // Get the total number of listens for the episodes in the creator's podcasts
        $totalListensThisWeek = Listen::whereIn('episode_id', function ($query) use ($podcastIds) {
            $query->select('id')
                ->from('episodes')
                ->whereIn('podcast_id', $podcastIds);
        })
            ->whereBetween('created_at', [ Carbon::now()->subDays(7), Carbon::now()]) // Filter listens within the past week
            ->count();

        $totalListensLastWeek = Listen::whereIn('episode_id', function ($query) use ($podcastIds) {
            $query->select('id')
                ->from('episodes')
                ->whereIn('podcast_id', $podcastIds);
        })
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]) // Filter listens within the previous week
            ->count();



        $totalSubscriptions = Podcast::where('creator_id', auth()->id())->sum('subscriber_count');
        $totalSubscriptionsThisWeek = Podcast::where('creator_id', auth()->id())
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('subscriber_count');

        $percentageChange = 0;
        if ($totalListensLastWeek != 0) {
            $percentageChange = (($totalListensThisWeek - $totalListensLastWeek) / $totalListensLastWeek) * 100;
        }

        $totalLikes = DB::table('likes')
            ->join('episodes', 'likes.episode_id', '=', 'episodes.id')
            ->join('podcasts', 'episodes.podcast_id', '=', 'podcasts.id')
            ->where('podcasts.creator_id', auth()->id())
            ->count();
        $totalLikesThisWeek = DB::table('likes')
            ->join('episodes', 'likes.episode_id', '=', 'episodes.id')
            ->join('podcasts', 'episodes.podcast_id', '=', 'podcasts.id')
            ->where('podcasts.creator_id', auth()->id())
            ->whereBetween('likes.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $totalFollowers = DB::table('follows')
            ->where('creator_id', auth()->id())
            ->count();
        $totalFollowersThisWeek = DB::table('follows')
            ->where('creator_id', auth()->id())
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

        $totalEpisodes = DB::table('episodes')
            ->where('creator_id', auth()->id())
            ->count();
        $totalEpisodesThisWeek = DB::table('episodes')
            ->where('creator_id', auth()->id())
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
        return view('dashboard', [
            'categories' => $categories,
            'podcasts' => $podcasts,
            'countPods' => $countPods,
            'totalListensThisWeek' => $totalListensThisWeek,
            'percentageChange' => $percentageChange,
            'totalSubscriptions' => $totalSubscriptions,
            'totalSubscriptionsThisWeek' => $totalSubscriptionsThisWeek,
            'totalLikes' => $totalLikes,
            'totalLikesThisWeek' => $totalLikesThisWeek,
            'totalFollowers' => $totalFollowers,
            'totalFollowersThisWeek' => $totalFollowersThisWeek,
            'totalEpisodes' => $totalEpisodes,
            'totalEpisodesThisWeek' => $totalEpisodesThisWeek
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
