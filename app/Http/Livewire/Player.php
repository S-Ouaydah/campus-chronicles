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
    // public $timePlayed;
    public $playing;
    public $position;

    protected $listeners = ['playAudio', 'saveProgress'];


    public function mount()
    {
        $this->getCookie();

    }

    public function playAudio($audioPath, $episodeId, $imageUrl, $position)
    {
        if ($audioPath == null || $this->audio == $audioPath) {
            return;
        }
        $this->audio = $audioPath;
        $this->episodeId = $episodeId;
        $this->imageUrl = $imageUrl;
        $this->position = $position;
    }

    public function saveProgress($totalTime,$source,$episodeId,$imageUrl,$playing,$position)
    {

        $this->setCookie($episodeId, $source, $imageUrl,$playing,$position);

        if (Auth::check() && $totalTime > 0) {
            $userId = Auth::id();
            $posColumn = 'time_played';

            $ratio = $position / $totalTime;
            $completed = $ratio >= 0.99;

            if ($this->episodeId && $position >= 10) {

                $listen = Listen::firstOrNew([
                    'user_id' => $userId,
                    'episode_id' => $this->episodeId,
                ]);

                if (!$listen->isComplete) {
                    if ($completed) {
                        $listen->isComplete = true;
                        $listen->time_played = $totalTime;
                        $listen->ratio_played = 1;
                        // $listen->completed_at = now();
                    } elseif ($position > $listen->time_played) {
                            $listen->ratio_played = $ratio;
                            $listen->time_played = $position;
                    }
                }

                $listen->save();
            }
        }else{
            dd($totalTime,$source,$episodeId,$imageUrl,$playing,$position);
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
        Cookie::queue('plyrCookie', json_encode($cookieValues), 3600*8); //for 8 hours

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
