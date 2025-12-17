<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Admin Pengaturan')]
#[Layout('layouts.sidebar')]

class Setting extends Component
{
    public function render()
    {
        return view('livewire.admin.setting');
    }
}
