<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriptions;
use App\Models\Podcast;

class SubscribeButton extends Component
{
    public $podcastId;
    public $subscribed;
    public $currentPage;

    public function mount($currentPage)
    {
        $this->currentPage = $currentPage;
        $this->subscribed = $this->checkIfSubscribed();
    }

    public function subscribe()
    {
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
        $userId = auth()->id();

        Subscriptions::where('podcast_id', $this->podcastId)
            ->where('user_id', $userId)
            ->delete();

        $this->subscribed = false;
        $this->decrementSubscriberCount();
    }

    public function render()
    {
        return view('livewire.subscribe-button', [
            'buttonClass' => $this->getButtonClass(),
        ]);
    }

    private function checkIfSubscribed()
    {
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

    public function getButtonClass()
    {
        if ($this->currentPage === 'explore') {
            return $this->subscribed ? 'bg-[#C0EE9B] text-black' : 'bg-[#C0EE9B] text-black';
        } else {
            return $this->subscribed ? 'bg-black text-white' : 'bg-black text-white';
        }
    }
}
