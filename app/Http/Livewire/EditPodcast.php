<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditPodcast extends Component
{
    public $podcast;
    public $title;
    public $description;

    public $editMode = false;

    public function mount($podcast)
    {
        $this->podcast = $podcast;
        $this->title = $podcast->title;
        $this->description = $podcast->description;
    }
    public function edit()
    {
        $this->editMode = true;
    }
    public function discard()
    {
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
