<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Episode;
use App\Models\Listen;

class NewEpisodes extends Component
{
    public $lastNewEpisodes;
    public $activeEpisodeIndex = 0;

    public function mount($lastNewEpisodes)
    {
        $this->lastNewEpisodes = $lastNewEpisodes;
    }

    public function showEpisode($index)
    {
        $this->activeEpisodeIndex = $index;
    }

    public function rotateEpisode()
    {
        $this->activeEpisodeIndex = ($this->activeEpisodeIndex + 1) % count($this->lastNewEpisodes);
    }

    public function render()
    {
        return view('livewire.new-episodes');
    }
}