<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listen;
use App\Models\Episode;

class ContinueListening extends Component
{
    public $epsToContinue;

    protected $listeners = ['render'];

    public $pourcentage;

    public function mount()
    {
        $this->refreshEpsToContinue();
       
    }

    public function render()
    {
        $epsToContinue = $this->getEpsToContinue();
        $nextEpisodes = $this-> getNextToWatch();

    
 
        return view('livewire.continue-listening', [
            "epsToContinue" => $epsToContinue,
            "nextEpisodes" => $nextEpisodes,
           

        ]);
    }


    public function getEpsToContinue()
    {
        $userId = Auth()->id();

        return Listen::where('user_id', $userId)
            ->where('isComplete', false)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();
    }

    public function getNextToWatch()
    {
        $userId = auth()->id();
    
        $latestListen = Listen::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
    
        if ($latestListen) {
            $podcastId = $latestListen->episode->podcast_id;
            $sequence = $latestListen->episode->sequence;
    
            $nextEpisodes = Episode::where('podcast_id', $podcastId)
                ->where('sequence', '>', $sequence)
                ->take(1)
                ->get()
                ->toArray();
    
            if (!empty($nextEpisodes)) {
                return $nextEpisodes;
            }
        }
    
        return [];
    }

    public function removeFromContinue($listenId)
    {
        $listen = Listen::findOrFail($listenId);
        $listen->delete();
        $this->epsToContinue = $this->getEpsToContinue();


    }

    public function refreshEpsToContinue()
    {
        $this->epsToContinue = $this->getEpsToContinue();
    }

    public function updatedEpsToContinue()
    {
        $this->emit('$refresh');
    }
}