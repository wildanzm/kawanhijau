<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Title('KawanHijau | Petani Penjualan')]
#[Layout('layouts.sidebar')]

class Sale extends Component
{
    use WithPagination;

    public $search = '';
    public $dateFilter = '';
    public $productFilter = '';
    public $perPage = 10;

    // Modal properties
    public $showModal = false;
    public $selectedSale = null;

    protected $queryString = ['search', 'dateFilter', 'productFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function updatingProductFilter()
    {
        $this->resetPage();
    }

    public function openViewModal($orderItemId)
    {
        $petaniProfile = Auth::user()->petaniProfile;
        
        $this->selectedSale = OrderItem::with(['order.user', 'product.category', 'order.paymentProof'])
            ->whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            })
            ->findOrFail($orderItemId);
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedSale = null;
    }

    public function render()
    {
        $petaniProfile = Auth::user()->petaniProfile;
        
        // Get sales (order items) from farmer's products that are paid/completed
        $query = OrderItem::with(['order.user', 'product.category'])
            ->whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            })
            ->orderBy('created_at', 'desc');

        // Search by invoice number or buyer name
        if ($this->search) {
            $query->whereHas('order', function($q) {
                $q->where('invoice_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($q) {
                      $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Product filter
        if ($this->productFilter) {
            $query->where('product_id', $this->productFilter);
        }

        // Date filter
        if ($this->dateFilter) {
            switch ($this->dateFilter) {
                case 'today':
                    $query->whereHas('order', function($q) {
                        $q->whereDate('created_at', today());
                    });
                    break;
                case 'week':
                    $query->whereHas('order', function($q) {
                        $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    });
                    break;
                case 'month':
                    $query->whereHas('order', function($q) {
                        $q->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    });
                    break;
                case 'year':
                    $query->whereHas('order', function($q) {
                        $q->whereYear('created_at', now()->year);
                    });
                    break;
            }
        }

        $sales = $query->paginate($this->perPage);

        // Calculate statistics
        $totalSales = OrderItem::whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            })
            ->sum('subtotal');

        $totalTransactions = OrderItem::whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            })
            ->distinct('order_id')
            ->count('order_id');

        $totalProductsSold = OrderItem::whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            })
            ->sum('quantity');

        // Monthly sales (this month)
        $monthlySales = OrderItem::whereHas('product', function($q) use ($petaniProfile) {
                $q->where('petani_profile_id', $petaniProfile->id ?? 0);
            })
            ->whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'completed'])
                  ->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
            })
            ->sum('subtotal');

        // Get farmer's products for filter
        $products = $petaniProfile ? $petaniProfile->products()->orderBy('name')->get() : collect();

        return view('livewire.petani.sale', [
            'sales' => $sales,
            'totalSales' => $totalSales,
            'totalTransactions' => $totalTransactions,
            'totalProductsSold' => $totalProductsSold,
            'monthlySales' => $monthlySales,
            'products' => $products,
            'petaniProfile' => $petaniProfile,
        ]);
    }
}
