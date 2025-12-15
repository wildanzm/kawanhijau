<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Dashboard')]
#[Layout('layouts.sidebar')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.petani.dashboard');
    }
}
