<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Listen;
use Illuminate\Support\Facades\Cookie;

class Player extends Component
{
    public $audio;
    public $episodeId;
    public $episodeTitle;
    public $imageUrl;
    public $durationPlayed;
    public $timePlayed;
    public $playing;
    public $position;

    protected $listeners = ['playAudio', 'continueAudio', 'saveProgress'];


    public function mount()
    {
        // $this->durationPlayed = 0; // Initialize durationPlayed to 0
        $this->getCookie();
        // $this->playAudio($this->audio,$this->episodeId,$this->imageUrl);

    }

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

    public function saveProgress($timePlayed, $totalTime, $completed,$source,$episodeId,$imageUrl,$playing,$position)
    {
        $this->durationPlayed = $timePlayed;

        $this->setCookie($episodeId, $source, $imageUrl,$playing,$position);

        if (Auth::check()) {
            $userId = Auth::id();
            $timeColumn = 'time_played';

            if ($this->episodeId && $this->durationPlayed >= 10) {
                $listen = Listen::where('user_id', $userId)
                    ->where('episode_id', $this->episodeId)
                    ->whereRaw("TIME_TO_SEC($timeColumn) < ?", [$totalTime - 1])
                    ->first();

                if ($listen) {
                    // Update the existing row
                    $listen->isComplete = $completed;
                    if ($completed) {
                        $listen->time_played = gmdate('H:i:s', $this->durationPlayed + 1);
                    } else {
                        $listen->time_played = gmdate('H:i:s', $this->durationPlayed);
                    }



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

    public function getCookie() {
        /** @var object $cookie */
        $cookie = json_decode(Cookie::get('plyrCookie'));
        if ($cookie) {
            $this->audio = $cookie->audio_path;
            $this->episodeId = $cookie->episodeId;
            $this->imageUrl = $cookie->imgUrl;
            $this->playing = $cookie->playing;
            $this->position = $cookie->position;
            // $this->playAudio($this->audio,$this->episodeId,$this->imageUrl);
        }
    }

    public function setCookie($episodeId, $audioPath, $imgUrl,$playing,$position) {
        $cookieValues = [
            'audio_path' => $audioPath,
            'episodeId' => $episodeId,
            'imgUrl' => $imgUrl,
            'playing' => $playing,
            'position' => $position,
        ];
        Cookie::queue('plyrCookie', json_encode($cookieValues), 3600*8); //valid for 8 hours

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
