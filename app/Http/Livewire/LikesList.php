<?php

namespace App\Http\Livewire;

use App\Models\Episode;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Livewire\Wire;
use Livewire\WithPagination;



class LikesList extends Component
{
    use WithPagination;
    public $items;
    public $sortedEpisodes;
    



    public function mount($items, $sortedEpisodes,)
    {
        $this->items = $items;
        $this->sortedEpisodes = $sortedEpisodes;
        
        
        
    }
    public function unlikeEpisode($episodeId)
    {
        
        $episode = Episode::findOrFail($episodeId);
        $episode->unlike();
        $this->sortedEpisodes = Episode::getLikesByCurrentUser();
        
    }

    public function render()
    {

        $episodes = Episode::getLikesByCurrentUser();
        

        return view('livewire.likes-list', [
            'episodes' => $episodes,
        ]);
    }
}

