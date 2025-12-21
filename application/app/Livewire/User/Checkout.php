<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

#[Title('KawanHijau | Checkout')]
#[Layout('layouts.main')]

class Checkout extends Component
{
    use WithFileUploads;

    public $cart;
    public $cartItems = [];
    public $shipping_address = '';
    public $notes = '';
    public $payment_proof;
    
    // Address fields
    public $recipient_name = '';
    public $phone_number = '';
    public $street_address = '';
    public $city = '';
    public $province = '';
    public $postal_code = '';

    public function mount()
    {
        // Get user's cart
        $this->cart = Cart::where('user_id', Auth::id())
            ->with(['items.product.category', 'items.product.petaniProfile.user'])
            ->first();

        if (!$this->cart || $this->cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong');
        }

        $this->cartItems = $this->cart->items;
        
        // Pre-fill with user data
        $user = Auth::user();
        $this->recipient_name = $user->name;
    }

    public function getSubtotalProperty()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function getShippingCostProperty()
    {
        // Flat shipping cost for now
        return 15000;
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->shippingCost;
    }

    public function processCheckout()
    {
        // Validate address and payment proof
        $this->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'street_address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'payment_proof' => 'required|image|max:2048', // Max 2MB
        ], [
            'recipient_name.required' => 'Nama penerima wajib diisi',
            'phone_number.required' => 'Nomor telepon wajib diisi',
            'street_address.required' => 'Alamat lengkap wajib diisi',
            'city.required' => 'Kota wajib diisi',
            'province.required' => 'Provinsi wajib diisi',
            'postal_code.required' => 'Kode pos wajib diisi',
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar',
            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal 2MB',
        ]);

        DB::beginTransaction();
        try {
            // Check stock availability
            foreach ($this->cartItems as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception('Stok ' . $item->product->name . ' tidak mencukupi');
                }
            }

            // Build shipping address
            $shippingAddress = "{$this->recipient_name}\n";
            $shippingAddress .= "{$this->phone_number}\n";
            $shippingAddress .= "{$this->street_address}\n";
            $shippingAddress .= "{$this->city}, {$this->province} {$this->postal_code}";
            
            if ($this->notes) {
                $shippingAddress .= "\nCatatan: {$this->notes}";
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
                'total_amount' => $this->total,
                'status' => 'paid',
                'shipping_address' => $shippingAddress,
            ]);

            // Create order items and update stock
            foreach ($this->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->product->price,
                    'subtotal' => $cartItem->product->price * $cartItem->quantity,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Upload and save payment proof
            $paymentProofPath = $this->payment_proof->store('payment-proofs', 'public');
            
            PaymentProof::create([
                'order_id' => $order->id,
                'image_path' => $paymentProofPath,
                'is_verified' => false,
            ]);

            // Clear cart
            $this->cart->items()->delete();
            $this->cart->delete();

            DB::commit();

            // Redirect to orders page with success message
            return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat! Invoice: ' . $order->invoice_number);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('checkout-error', ['message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.user.checkout');
    }
}
