<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Episode;

class PodcastEpisodes extends Component
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
        $user = auth()->user();
        if(!$user){
            return redirect()->route('login');
        }
        $episode = Episode::findOrFail($episodeId);
        // $episode = Episode::find($episodeId)->first();
        if($episode->isLikedBy($user)){
            $episode->unlike();
            return;
        }
        $episode->like();
    }
    public function render()
    {
        return view('livewire.podcast-episodes',['episodes' => $this->episodes]);
    }
}
