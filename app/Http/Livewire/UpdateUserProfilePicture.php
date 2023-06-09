<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfilePicture extends Component
{
    use WithFileUploads;

    public $profilePicture;
    public function openProfilePictureUpload()
    {
        $this->dispatchBrowserEvent('openProfilePictureUpload');
    }

    public function updatedProfilePicture()
    {
        // TODO give an error
        $this->validate([
            'profilePicture' => 'image|max:1048576', // 1MB Max
        ]);

        $user = Auth::user();
        $previousProfilePicture = $user->pfp_path;

        // Delete the previous profile picture if it exists
        if ($previousProfilePicture) {
            Storage::delete('public/user_profiles/' . basename($previousProfilePicture));
        }

        // Store the new profile picture
        $newProfilePicture = $this->profilePicture->store('public/user_profiles');
        $user->pfp_path = "storage/user_profiles/". basename($newProfilePicture);
        $user->save();

        // Emit an event to refresh the parent component
        $this->emit('profilePictureUpdated');
    }

    public function render()
    {
        return view('livewire.update-user-profile-picture',[
            "pfpPath" => Auth::user()->profile_pic(),

        ]);

    }
}
