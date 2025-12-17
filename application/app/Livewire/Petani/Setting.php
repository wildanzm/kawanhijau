<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Pengaturan')]
#[Layout('layouts.sidebar')]

class Setting extends Component
{
    public function render()
    {
        return view('livewire.petani.setting');
    }
}
