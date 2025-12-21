<?php

namespace App\Livewire\User\Product;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.main')]
class Detail extends Component
{
    public $productId;
    public $product;
    public $quantity = 1;
    public $selectedImage;

    public function mount($id)
    {
        $this->productId = $id;
        $this->product = Product::with(['category', 'petaniProfile.user'])
            ->where('is_active', true)
            ->findOrFail($id);
        
        $this->selectedImage = $this->product->image_path;
    }

    public function getTitle()
    {
        return 'KawanHijau | ' . ($this->product->name ?? 'Detail Produk');
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updatedQuantity($value)
    {
        // Ensure quantity is within valid range
        if ($value < 1) {
            $this->quantity = 1;
        } elseif ($value > $this->product->stock) {
            $this->quantity = $this->product->stock;
        }
    }

    public function addToCart()
    {
        $this->validate([
            'quantity' => 'required|integer|min:1|max:' . $this->product->stock,
        ]);

        // Get or create cart for the user
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        // Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            // Update quantity if product already in cart
            $newQuantity = $cartItem->quantity + $this->quantity;
            
            // Check stock availability
            if ($newQuantity > $this->product->stock) {
                $this->dispatch('cart-error', [
                    'message' => 'Stok tidak mencukupi! Maksimal ' . $this->product->stock . ' ' . ($this->product->unit ?? 'unit'),
                ]);
                return;
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Add new item to cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
        }

        // Dispatch success event
        $this->dispatch('cart-updated', [
            'product_name' => $this->product->name,
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
        ]);

        // Reset quantity after adding to cart
        $this->quantity = 1;
    }


    public function render()
    {
        return view('livewire.user.product.detail');
    }
}
