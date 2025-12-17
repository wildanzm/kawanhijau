<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Pesanan')]
#[Layout('layouts.sidebar')]

class Order extends Component
{
    public function render()
    {
        return view('livewire.petani.order');
    }
}
