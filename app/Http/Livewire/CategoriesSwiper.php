<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PodcastCategory;
use App\Models\Podcast;

class CategoriesSwiper extends Component
{
    public $activeTab;
    public $categories;
    public $podcasts;

    public function mount()
    {
        $this->categories = PodcastCategory::all();
        $this->activeTab = $this->categories->first()->id;
    }

    public function render()
    {
        $this->podcasts = Podcast::where('category_id', $this->activeTab)->get();

        return view('livewire.categories-swiper', [
            'categories' => $this->categories,
            'podcasts' => $this->podcasts,
        ]);
    }

    public function openTab($categoryId)
    {
        $this->activeTab = $categoryId;
        $this->dispatchBrowserEvent('tabChanged');
    }
}
