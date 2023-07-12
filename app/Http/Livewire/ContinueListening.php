<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listen;
use App\Models\Episode;
use Carbon\Carbon;


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
    
        $completedPodcasts = Listen::select('episodes.podcast_id')
            ->join('episodes', 'listens.episode_id', '=', 'episodes.id')
            ->where('listens.user_id', $userId)
            ->where('listens.isComplete', 1)
            ->groupBy('episodes.podcast_id')
            ->pluck('episodes.podcast_id')
            ->toArray();
    
        $nextEpisodes = [];
        
        foreach ($completedPodcasts as $podcastId) {
            $latestListen = Listen::where('user_id', $userId)
                ->where('isComplete', 1)
                ->whereHas('episode', function ($query) use ($podcastId) {
                    $query->where('podcast_id', $podcastId);
                })
                ->orderBy('created_at', 'desc')
                ->first();
    
            if ($latestListen) {
                $sequence = $latestListen->episode->sequence;
    
                $nextEpisode = Episode::where('podcast_id', $podcastId)
                    ->where('sequence', '>', $sequence)
                    ->orderBy('sequence')
                    ->first();
    
                if ($nextEpisode) {
                    $nextEpisodes[] = $nextEpisode;
                }
            }
        }
    
        return $nextEpisodes;
    }
    

    public function isNewEp($episodeId)
    {
        $episode = Episode::find($episodeId);

        if ($episode) {
            $createdAt = Carbon::parse($episode->created_at);
            $lastWeek = Carbon::now()->subWeek();

            return $createdAt->greaterThanOrEqualTo($lastWeek);
        }

        return false;
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