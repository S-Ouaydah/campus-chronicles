<?php

namespace App\Http\Livewire;

use App\Models\Podcast;
use Livewire\Component;

class SearchBar extends Component
{
    public $query;
    public $podcasts;
    // public $highlightindex;

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

    // public function incrementHighlight()
    // {
    //     if ($this->highlightindex === count($this->podcasts) - 1) {
    //         $this->highlightindex =0;
    //         return;
    //     }
    //     $this->highlightindex++;
    // }

    // public function decrementHighlight()
    // {
    //     if ($this->highlightindex === 0) {
    //         $this->highlightindex = count($this->podcasts) - 1;
    //         return;
    //     }
    //     $this->highlightindex--;
    // }

    public function updatedQuery()
    {
        // sleep(2);  data delay testing
        $this->podcasts = Podcast::whereRaw('lower(title) like ?', ['%' . strtolower($this->query) . '%'])
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
