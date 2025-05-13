<?php

namespace App\Livewire\Frontend;

use App\Models\Speciality;
use Livewire\Component;

class SpecialistCards extends Component
{
    public $specialist_cards;

    public function mount()
    {
        $this->specialist_cards = Speciality::all();
    }

    public function render()
    {
        return view('livewire.frontend.specialist-cards');
    }
}