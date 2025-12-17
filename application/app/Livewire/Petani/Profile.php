<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Profil')]
#[Layout('layouts.sidebar')]

class Profile extends Component
{
    public function render()
    {
        return view('livewire.petani.profile');
    }
}
