<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Episode;
use Illuminate\Support\Facades\Auth;
class EpisodesSearch extends Component
{
    public $podcast;
    public $episodes;

    public function mount($podcast,$episodes)
    {
        $this->podcast = $podcast;
        $this->episodes = $episodes;
    }
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
        return view('livewire.episodes-search',['episodes' => $this->episodes]);
    }
}