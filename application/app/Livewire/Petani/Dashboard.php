<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Title('KawanHijau | Petani Dashboard')]
#[Layout('layouts.sidebar')]
class Dashboard extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        $user = Auth::user();
        $petaniProfile = $user->petaniProfile;

        // Total Products
        $totalProducts = 0;
        $totalOrders = 0;
        $totalSales = 0;
        $products = collect();

        if ($petaniProfile) {
            // Total Products
            $totalProducts = Product::where('petani_profile_id', $petaniProfile->id)->count();

            // Get products with pagination
            $products = Product::where('petani_profile_id', $petaniProfile->id)
                ->with('category')
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage);

            // Total Orders (this month) - counting order items from this farmer's products
            $totalOrders = OrderItem::whereHas('product', function($query) use ($petaniProfile) {
                    $query->where('petani_profile_id', $petaniProfile->id);
                })
                ->whereHas('order', function($query) {
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                })
                ->distinct('order_id')
                ->count('order_id');

            // Total Sales (this month) - sum of order items from this farmer's products
            $totalSales = OrderItem::whereHas('product', function($query) use ($petaniProfile) {
                    $query->where('petani_profile_id', $petaniProfile->id);
                })
                ->whereHas('order', function($query) {
                    $query->where('status', 'completed')
                          ->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                })
                ->sum('subtotal');
        }

        return view('livewire.petani.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'products' => $products,
            'petaniProfile' => $petaniProfile,
        ]);
    }
}
