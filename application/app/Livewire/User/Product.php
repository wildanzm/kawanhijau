<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Product as ProductModel;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('KawanHijau | Daftar Produk')]
#[Layout('layouts.main')]
class Product extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = [];
    public $minPrice = '';
    public $maxPrice = '';
    public $sortBy = 'latest';
    public $showFilters = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => []],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingMinPrice()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->selectedCategory = [];
        $this->minPrice = '';
        $this->maxPrice = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    public function addToCart($productId)
    {
        $product = ProductModel::findOrFail($productId);
        
        // Get or create cart for the user
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        // Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update quantity if product already in cart
            $newQuantity = $cartItem->quantity + 1;
            
            // Check stock availability
            if ($newQuantity > $product->stock) {
                $this->dispatch('cart-error', [
                    'message' => 'Stok tidak mencukupi!',
                ]);
                return;
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Add new item to cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        // Dispatch success event
        $this->dispatch('cart-updated', [
            'product_name' => $product->name,
            'product_id' => $productId,
        ]);
    }

    public function render()
    {
        $query = ProductModel::query()
            ->where('is_active', true)
            ->where('stock', '>', 0);

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Category Filter
        if (!empty($this->selectedCategory)) {
            $query->whereIn('category_id', $this->selectedCategory);
        }

        // Price Range Filter
        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }
        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        // Sorting
        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();

        return view('livewire.user.product', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
