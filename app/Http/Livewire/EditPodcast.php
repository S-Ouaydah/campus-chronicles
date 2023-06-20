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
    }
    public function edit()
    {
        $this->editMode = true;
    }
    public function discard()
    {
        $this->title = $this->originalTitle;
        $this->description = $this->originalDescription;

        $this->editMode = false;
    }
    public function save()
    {
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
