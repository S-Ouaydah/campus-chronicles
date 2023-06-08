<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;



class EditBio extends Component
{
    public $bio = '' ;
    public $editing = false;
    public $originalBio;
    public $user;
    public $extraLinesClass = '';
    


    protected function linesCountRule($maxLines)
    {
        return function ($attribute, $value, $fail) use ($maxLines) {
            if (substr_count($value, "\n") >= $maxLines) {
                $fail("The {$attribute} must not exceed {$maxLines} lines.");
            }
        };
    }





    


    

    public function checkLines()
    {
        $lines = explode("\n", $this->bio);
        if (count($lines) > 3) {
            $this->bio = implode("\n", array_slice($lines, 0, 3));
            return;
        }

        // Check character limit on the third line
        if (count($lines) === 3) {
            $lastLine = $lines[2];

            // Check if the last line is full
            if (strlen($lastLine) >= 56) { // Adjust the character limit (64) as needed
                // Remove the last character from the last line
                $lines[2] = substr($lastLine, 0, -1);
                $this->bio = implode("\n", $lines);
            }
        }
        
    }

    public function updatedBio()
    {
        $this->checkLines();
    }
    public function mount()
    {
        $this->user = Auth::user();
        $this->bio = $this->user->bio;
        $this->originalBio = $this->bio;
        
   
    }
    public function startEditing()
    {
        $this->editing = true;
    }

    public function cancelEditing()
    {
        $this->bio = $this->originalBio;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.edit-bio');
    }



    public function saveBio()
    {
        $this->validate([
            'bio' => ['nullable', 'max:255', $this->linesCountRule(3)],
        ], [], [
                'bio' => 'Bio',
            ]);
        $this->user->bio = $this->bio;
        $this->user->save();

        $this->originalBio = $this->bio;
        $this->editing = false;

    }

}