<?php

namespace App\Livewire\User;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Home')]
#[Layout('layouts.main')]
class Home extends Component
{
    public function render()
    {
        $featuredProducts = Product::with('category', 'petaniProfile.user')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->take(6)
            ->get();

        return view('livewire.user.home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
}
