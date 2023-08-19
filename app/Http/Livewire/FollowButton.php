<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{

    public $followed;
    public $creatorId;

    public function mount($creatorId)
    {
        $this->creatorId = $creatorId;
        $this->followed = $this->checkIfFollowed();
    }

    public function follow()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $creator = User::findOrFail($this->creatorId);
        $creator->followers()->attach($user);
        $this->followed = true;


    }
    public function unfollow()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $creator = User::findOrFail($this->creatorId);
        $creator->followers()->detach($user);
        $this->followed = false;
    }
    private function checkIfFollowed()
    {
        $userId = auth()->id();

        $creator = User::findOrFail($this->creatorId);
        return $creator->followers()->where('follower_id', $userId)->exists();
    }
    public function render()
    {
        return view('livewire.follow-button');
    }
}
