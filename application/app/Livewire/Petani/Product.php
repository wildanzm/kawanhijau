<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Petani Produk')]
#[Layout('layouts.sidebar')]

class Product extends Component
{
    public function render()
    {
        return view('livewire.petani.product');
    }
}
