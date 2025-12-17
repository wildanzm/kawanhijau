<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Penjualan')]
#[Layout('layouts.sidebar')]

class Sale extends Component
{
    public function render()
    {
        return view('livewire.petani.sale');
    }
}
