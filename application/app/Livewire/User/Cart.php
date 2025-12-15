<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Cart as CartModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

#[Title('KawanHijau | Keranjang')]
#[Layout('layouts.main')]
class Cart extends Component
{
    public $selectedItems = [];
    public $selectAll = false;

    public function mount()
    {
        // Initialize selected items with all cart item IDs
        $cart = $this->getUserCart();
        if ($cart) {
            $this->selectedItems = $cart->items->pluck('id')->toArray();
            $this->selectAll = true;
        }
    }

    public function updatedSelectAll($value)
    {
        $cart = $this->getUserCart();
        if ($value && $cart) {
            $this->selectedItems = $cart->items->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        $cart = $this->getUserCart();
        if ($cart) {
            $this->selectAll = count($this->selectedItems) === $cart->items->count();
        }
    }

    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity < 1) {
            return;
        }

        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->first();

        if ($cartItem) {
            // Check if quantity exceeds stock
            if ($quantity > $cartItem->product->stock) {
                $this->dispatch('show-alert', [
                    'type' => 'error',
                    'message' => 'Jumlah melebihi stok tersedia!'
                ]);
                return;
            }

            $cartItem->update(['quantity' => $quantity]);
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($itemId)
    {
        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->selectedItems = array_diff($this->selectedItems, [$itemId]);
            $this->dispatch('cart-updated');
            $this->dispatch('show-alert', [
                'type' => 'success',
                'message' => 'Produk berhasil dihapus dari keranjang'
            ]);
        }
    }

    public function removeSelected()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('show-alert', [
                'type' => 'warning',
                'message' => 'Pilih produk yang ingin dihapus'
            ]);
            return;
        }

        CartItem::whereIn('id', $this->selectedItems)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->delete();

        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('cart-updated');
        $this->dispatch('show-alert', [
            'type' => 'success',
            'message' => 'Produk terpilih berhasil dihapus'
        ]);
    }

    public function checkout()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('show-alert', [
                'type' => 'warning',
                'message' => 'Pilih produk yang ingin dibeli'
            ]);
            return;
        }

        // Store selected items in session for checkout
        session(['checkout_items' => $this->selectedItems]);
        return redirect()->route('checkout');
    }

    private function getUserCart()
    {
        if (!Auth::check()) {
            return null;
        }

        return CartModel::with(['items.product.category'])
            ->where('user_id', Auth::user()->id)
            ->first();
    }

    public function getSelectedTotalProperty()
    {
        $cart = $this->getUserCart();
        if (!$cart) {
            return 0;
        }

        return $cart->items
            ->whereIn('id', $this->selectedItems)
            ->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
    }

    public function render()
    {
        $cart = $this->getUserCart();

        return view('livewire.user.cart', [
            'cart' => $cart,
            'selectedTotal' => $this->getSelectedTotalProperty(),
        ]);
    }
}
