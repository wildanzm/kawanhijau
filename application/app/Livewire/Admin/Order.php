<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Storage;

#[Title('KawanHijau | Admin Pesanan')]
#[Layout('layouts.sidebar')]

class Order extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';
    public $perPage = 10;

    // Modal properties
    public $showModal = false;
    public $selectedOrder = null;
    public $paymentProof = null;

    protected $queryString = ['search', 'statusFilter', 'dateFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function openViewModal($orderId)
    {
        $this->selectedOrder = OrderModel::with(['user', 'orderItems.product', 'paymentProof'])
            ->findOrFail($orderId);
        
        if ($this->selectedOrder->paymentProof) {
            $this->paymentProof = $this->selectedOrder->paymentProof;
        }
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
        $this->paymentProof = null;
    }

    public function verifyPayment($orderId)
    {
        $order = OrderModel::findOrFail($orderId);
        
        if ($order->status === 'paid' || $order->status === 'completed') {
            $this->dispatch('payment-error', message: 'Pesanan ini sudah diverifikasi atau tidak memiliki bukti pembayaran.');
            return;
        }

        if (!$order->paymentProof) {
            $this->dispatch('payment-error', message: 'Tidak ada bukti pembayaran untuk pesanan ini.');
            return;
        }

        $order->update([
            'status' => 'paid'
        ]);

        $order->paymentProof->update([
            'verified_at' => now()
        ]);

        $this->closeModal();
        $this->dispatch('payment-verified', message: 'Pembayaran berhasil diverifikasi!');
    }

    public function rejectPayment($orderId)
    {
        $order = OrderModel::findOrFail($orderId);
        
        if ($order->status === 'paid' || $order->status === 'completed') {
            $this->dispatch('payment-error', message: 'Pesanan ini sudah diverifikasi.');
            return;
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        $this->closeModal();
        $this->dispatch('payment-rejected', message: 'Pembayaran ditolak.');
    }

    public function render()
    {
        $query = OrderModel::with(['user', 'orderItems', 'paymentProof'])
            ->orderBy('created_at', 'desc');

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('invoice_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($q) {
                      $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Date filter
        if ($this->dateFilter) {
            switch ($this->dateFilter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month);
                    break;
            }
        }

        $orders = $query->paginate($this->perPage);

        // Stats
        $totalOrders = OrderModel::count();
        $pendingOrders = OrderModel::where('status', 'pending')->count();
        $paidOrders = OrderModel::where('status', 'paid')->count();
        $totalRevenue = OrderModel::where('status', 'paid')->sum('total_amount');

        return view('livewire.admin.order', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'paidOrders' => $paidOrders,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
