<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Podcast;
use App\Models\Episode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeaturedPodcast extends Component
{

    public function like($episodeId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
    
        $episode = Episode::findOrFail($episodeId);
    
        $likes = $episode->getLikesByCurrentUser();
    
        if ($likes->contains('episode_id', $episode->id)) {
            // Episode is already liked by the user, so unlike it
            $episode->unlike();
        } else {
            // Like the episode
            $episode->like();
        }
    }
    

    

    public function render()
    {
        $today = Carbon::today();
        $featuredPodcast = Podcast::all()->nth($today->dayOfYear() % Podcast::count())->first();
        $featuredPodcastEps = $featuredPodcast->episodes;
        return view('livewire.featured-podcast',[
            "featuredPodcast" => $featuredPodcast,
            "featuredPodcastEps" => $featuredPodcastEps,
        ]);
    }
}
