<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Auth;

#[Title('KawanHijau | Pesanan Saya')]
#[Layout('layouts.main')]

class Order extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;

    // Modal
    public $showModal = false;
    public $selectedOrder = null;

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openViewModal($orderId)
    {
        $this->selectedOrder = OrderModel::with(['orderItems.product.category', 'paymentProof'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function confirmReceived($orderId)
    {
        $order = OrderModel::where('user_id', Auth::id())
            ->where('id', $orderId)
            ->where('status', 'shipping')
            ->firstOrFail();

        $order->update(['status' => 'completed']);

        $this->dispatch('order-completed', [
            'message' => 'Pesanan berhasil dikonfirmasi sebagai diterima'
        ]);
    }

    public function render()
    {
        $query = OrderModel::with(['orderItems.product', 'paymentProof'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        // Search by invoice number
        if ($this->search) {
            $query->where('invoice_number', 'like', '%' . $this->search . '%');
        }

        // Status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $orders = $query->paginate($this->perPage);

        // Calculate statistics
        $totalOrders = OrderModel::where('user_id', Auth::id())->count();
        $pendingOrders = OrderModel::where('user_id', Auth::id())->where('status', 'pending')->count();
        $shippingOrders = OrderModel::where('user_id', Auth::id())->where('status', 'shipping')->count();
        $completedOrders = OrderModel::where('user_id', Auth::id())->where('status', 'completed')->count();

        return view('livewire.user.order', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'shippingOrders' => $shippingOrders,
            'completedOrders' => $completedOrders,
        ]);
    }
}
