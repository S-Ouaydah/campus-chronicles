<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Auth;

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
        // $this->validate([
        //     'profilePicture' => 'image|max:1024', // 1MB Max
        // ]);
        

        $user = Auth::user();
        $previousProfilePicture = $user->pfp_path;

        // Delete the previous profile picture if it exists
        if ($previousProfilePicture) {
            Storage::delete('storage/usersPfp/' . basename($previousProfilePicture));
        }

        // Store the new profile picture
        $newProfilePicture = $this->profilePicture->store('public/usersPfp');
        $user->pfp_path = "storage/usersPfp/". basename($newProfilePicture);
        $user->save();

        // Emit an event to refresh the parent component
        $this->emit('profilePictureUpdated');
    }

    public function render()
    {
        $pfpPath = Auth::user()->fetchPfp();
        return view('livewire.update-user-profile-picture',[
            "pfpPath" => $pfpPath,

        ]);
            
    }
}
