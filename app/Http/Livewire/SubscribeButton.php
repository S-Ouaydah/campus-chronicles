<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriptions;
use App\Models\Podcast;

class SubscribeButton extends Component
{
    public $podcastId;
    public $subscribed;

    public function mount()
    {
        $this->subscribed = $this->checkIfSubscribed();
    }

    public function subscribe()
    {
        // Get the authenticated user's ID or adjust this logic based on your authentication setup
        $userId = auth()->id();

        Subscriptions::create([
            'podcast_id' => $this->podcastId,
            'user_id' => $userId,
        ]);

        $this->subscribed = true;
        $this->incrementSubscriberCount();

       
    }

    public function unsubscribe()
    {
        // Get the authenticated user's ID or adjust this logic based on your authentication setup
        $userId = auth()->id();

        Subscriptions::where('podcast_id', $this->podcastId)
            ->where('user_id', $userId)
            ->delete();

        $this->subscribed = false;
        $this->decrementSubscriberCount();

    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }


    private function checkIfSubscribed()
    {
        // Get the authenticated user's ID or adjust this logic based on your authentication setup
        $userId = auth()->id();

        return Subscriptions::where('podcast_id', $this->podcastId)
            ->where('user_id', $userId)
            ->exists();
    }

    private function incrementSubscriberCount()
    {
        $podcast = Podcast::find($this->podcastId);
        $podcast->subscriber_count += 1;
        $podcast->save();
    }

    private function decrementSubscriberCount()
    {
        $podcast = Podcast::find($this->podcastId);
        $podcast->subscriber_count -= 1;
        $podcast->save();
    }
}