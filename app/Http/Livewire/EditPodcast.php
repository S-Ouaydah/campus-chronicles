<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class EditPodcast extends Component
{
    use WithFileUploads;

    public $podcast;
    public $title;
    public $description;
    public $pod_pic;

    public $editMode = false;

    public $originalTitle;
    public $originalDescription;
    public $originalPodPic;

    

    public function mount($podcast)
    {
        $this->podcast = $podcast;
        $this->title = $podcast->title;
        $this->description = $podcast->description;
        $this->originalTitle = $this->title;
        $this->originalDescription = $this->description;
        $this->originalPodPic = $this->podcast->image_url;
    }
    public function edit()
    {
        $this->editMode = true;
    }
    public function discard()
    {
        $this->title = $this->originalTitle;
        $this->description = $this->originalDescription;
        $this->pod_pic = $this->originalPodPic;

        $this->editMode = false;
    }
    public function save()
    {
        if ($this->pod_pic) {
            $filename = $this->pod_pic->getClientOriginalName();
            $imagePath = $this->pod_pic->storeAs('public/podcast-pics', $filename);
            $this->podcast->image_url = 'storage/podcast-pics/' . $filename;
        }
        $this->podcast->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->editMode = false;
    }
    public function render()
    {
        return view('livewire.edit-podcast',['editMode' => $this->editMode]);

    }
}
