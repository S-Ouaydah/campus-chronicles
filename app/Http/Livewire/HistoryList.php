<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Listen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Wire;
use Livewire\WithPagination;

class HistoryList extends Component
{

    public $sortedHistory;
    public function mount($sortedHistory)
    {

        $this->sortedHistory = $sortedHistory;
    }

    public function removeEpisodeH($listenId)
    {
        $listen = Listen::findOrFail($listenId);
        $listen->delete();


        $this->sortedHistory = Listen::getHistoryByUser(Auth::user()->id);

    }




    public function render()
    {

        $historyTable = Listen::getHistoryByUser(Auth::user()->id);


        return view('livewire.history-list', [
            'historyTable' => $historyTable,
            
            
        ]);
    }
}