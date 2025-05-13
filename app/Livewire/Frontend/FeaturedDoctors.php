<?php

namespace App\Livewire\Frontend;

use App\Models\Doctor;
use Livewire\Component;

class FeaturedDoctors extends Component
{
    public $featuredDoctors= [];

    public function mount()
    {
        $this->featuredDoctors = Doctor::with(['speciality', 'user'])->where('is_featured', true)->get();
    }
    
    public function render()
    {
        
        return view('livewire.frontend.featured-doctors');
    }
}