<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Title('KawanHijau | Petani Pesanan')]
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
    public $myOrderItems = [];

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
        $petaniProfile = Auth::user()->petaniProfile;
        
        $this->selectedOrder = OrderModel::with(['user', 'orderItems.product.category', 'paymentProof'])
            ->findOrFail($orderId);
        
        // Filter only items that belong to this farmer
        $this->myOrderItems = $this->selectedOrder->orderItems->filter(function($item) use ($petaniProfile) {
            return $item->product && $item->product->petani_profile_id == $petaniProfile->id;
        });
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
        $this->myOrderItems = [];
    }

    public function updateOrderStatus($orderId, $newStatus)
    {
        $order = OrderModel::findOrFail($orderId);
        
        // Validate status transition
        $allowedTransitions = [
            'paid' => 'shipping',
            'shipping' => 'completed',
        ];

        if (!isset($allowedTransitions[$order->status]) || $allowedTransitions[$order->status] !== $newStatus) {
            $this->dispatch('status-error', ['message' => 'Transisi status tidak valid']);
            return;
        }

        $order->update(['status' => $newStatus]);
        
        $statusLabel = [
            'shipping' => 'Dikirim',
            'completed' => 'Selesai',
        ];

        $this->dispatch('status-updated', [
            'message' => 'Status pesanan berhasil diubah menjadi ' . $statusLabel[$newStatus]
        ]);
    }

    public function render()
    {
        $petaniProfile = Auth::user()->petaniProfile;
        
        // Get orders that contain this farmer's products
        $query = OrderModel::with(['user', 'orderItems.product', 'paymentProof'])
            ->whereHas('orderItems.product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->orderBy('created_at', 'desc');

        // Search by invoice number or buyer name
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
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
            }
        }

        $orders = $query->paginate($this->perPage);

        // Calculate stats for this farmer
        $totalOrders = OrderModel::whereHas('orderItems.product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })->count();

        $pendingOrders = OrderModel::where('status', 'pending')
            ->whereHas('orderItems.product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })->count();

        $completedOrders = OrderModel::whereIn('status', ['completed'])
            ->whereHas('orderItems.product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })->count();

        // Total revenue from this farmer's products
        $totalRevenue = OrderItem::whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->where('status', 'completed');
            })
            ->sum('subtotal');

        return view('livewire.petani.order', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'totalRevenue' => $totalRevenue,
            'petaniProfile' => $petaniProfile,
        ]);
    }
}
