<?php

namespace App\Livewire\Frontend;

use App\Models\Doctor;
use Livewire\Component;

class ProfileImage extends Component
{
    public $featuredDoctor;

    public function mount($id)
    {
        $this->featuredDoctor = Doctor::find($id);
    }
    public function render()
    {
        return view('livewire.frontend.profile-image');
    }
}
