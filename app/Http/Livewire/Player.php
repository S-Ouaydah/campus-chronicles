<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Player extends Component
{

    protected $listeners = ['playAudio'];

    public $audio;

    public function playAudio($audio)
    {
        // TODO: implement pause
        if($audio == null || $this->audio == $audio){
            return;
        }
        $this->audio = $audio;
    }

    public function render()
    {
        return view('livewire.player',['source' => asset($this->audio)]);
    }
}
