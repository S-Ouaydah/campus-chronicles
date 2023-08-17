<?php

namespace App\Http\Livewire;

use App\Models\Episode;
use App\Models\Podcast;
use App\Models\User;
use Livewire\Component;

class SearchBar extends Component
{
    public $query;
    public $podcasts;
    public $episodes;
    public $creators;

    public function mount()
    {
        $this->resets();
    }

    public function resets()
    {
        $this->query = '';
        $this->podcasts = [];
        // $this->highlightindex = 0;
    }

    public function updatedQuery()
    {
        // sleep(2);  data delay testing
        $this->podcasts = Podcast::whereRaw('lower(title) like ?', ['%' . strtolower($this->query) . '%'])
            ->get()
            ->toArray();
        $this->episodes = Episode::whereRaw('lower(title) like ?', ['%' . strtolower($this->query) . '%'])
            ->get()
            ->toArray();
        $this->creators = User::whereRaw('lower(name) like ?', ['%' . strtolower($this->query) . '%'])
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
