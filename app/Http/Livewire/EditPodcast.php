<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditPodcast extends Component
{
    use WithFileUploads;

    public $podcast;
    public $title;
    public $description;
    public $podPic;

    public $editMode = false;

    public $originalTitle;
    public $originalDescription;


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
        // $this->pod_pic = $this->originalPodPic;

        $this->editMode = false;
    }
    public function save()
    {
        // if ($this->pod_pic) {
        //     $filename = $this->pod_pic->getClientOriginalName();
        //     $imagePath = $this->pod_pic->storeAs('public/podcast-pics', $filename);
        //     $this->podcast->image_url = 'storage/podcast-pics/' . $filename;
        // }
        $this->originalTitle = $this->title;
        $this->originalDescription = $this->description;

        $this->podcast->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->editMode = false;
    }
    public function updatedPodPic()
    {
        // TODO give an error
        $this->validate([
            'podPic' => 'image|max:2048576', // 2MB Max
        ]);
        $user = Auth::user();
        $previousPodPic = $user->pod_pic;
        if ($previousPodPic) {
            Storage::delete('public/podcast-pics/' . basename($previousPodPic));
        }
        //store the new podcast picture
        $newPodPic = $this->podPic->store('public/podcast-pics');
        $this->podcast->image_url = "storage/podcast-pics/". basename($newPodPic);
        $this->podcast->save();
        flash('picture updated successfully!', 'success');

     }
    public function render()
    {
        return view('livewire.edit-podcast',['editMode' => $this->editMode]);

    }
}
