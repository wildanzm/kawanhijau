<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

#[Title('KawanHijau | Admin Dashboard')]
#[Layout('layouts.sidebar')]
class Dashboard extends Component
{
    public $totalUsers;
    public $totalOrders;
    public $totalProducts;
    
    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalOrders = Order::count();
        $this->totalProducts = Product::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
