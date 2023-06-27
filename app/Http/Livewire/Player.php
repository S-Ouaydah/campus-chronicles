<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Listen;

class Player extends Component
{
    public $audio;
    public $episodeId;
    public $imageUrl;
    public $durationPlayed;
    public $timePlayed;


    protected $listeners = ['playAudio', 'continueAudio', 'saveProgress',];

    public function playAudio($audioPath, $episodeId, $imageUrl)
    {
        if ($audioPath == null || $this->audio == $audioPath) {
            return;
        }
        $this->audio = $audioPath;
        $this->episodeId = $episodeId;
        $this->imageUrl = $imageUrl;
    }

    public function continueAudio($audioPath, $episodeId, $imageUrl, $timePlayed)
    {
        if ($audioPath == null || $this->audio == $audioPath) {
            return;
        }
        $this->audio = $audioPath;
        $this->episodeId = $episodeId;
        $this->imageUrl = $imageUrl;
        $this->timePlayed = $timePlayed;



    }

    public function mount()
    {
        $this->durationPlayed = 0;// Initialize durationPlayed to 0
    }



    public function saveProgress($timePlayed, $totalTime, $completed)
    {
        $this->durationPlayed = $timePlayed;

        if (Auth::check()) {
            $userId = Auth::id();
            $timeColumn = 'time_played';

            if ($this->episodeId && $this->durationPlayed >= 10) {
                $listen = Listen::where('user_id', $userId)
                    ->where('episode_id', $this->episodeId)
                    ->whereRaw("TIME_TO_SEC($timeColumn) < ?", [$totalTime])
                    ->first();

                if ($listen) {
                    // Update the existing row
                    $listen->isComplete = $completed;
                    $listen->time_played = $this->durationPlayed;
                    $listen->save();
                    if ($this->durationPlayed === $totalTime)
                        return;

                } else {
                    // Create a new row
                    if ($this->durationPlayed < $totalTime) {
                        Listen::create([
                            'user_id' => $userId,
                            'episode_id' => $this->episodeId,
                            'time_played' => $this->durationPlayed,
                            'isComplete' => $completed,
                        ]);
                    }

                }
            }
        }
    }


    public function render()
    {
        return view('livewire.player', [
            'source' => asset($this->audio),
            'episodeId' => $this->episodeId,
            'imageUrl' => $this->imageUrl,
        ]);
    }
}