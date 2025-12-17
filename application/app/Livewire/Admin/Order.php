<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Admin Pesanan')]
#[Layout('layouts.sidebar')]

class Order extends Component
{
    public function render()
    {
        return view('livewire.admin.order');
    }
}
