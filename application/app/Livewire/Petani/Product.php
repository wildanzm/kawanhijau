<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Title('KawanHijau | Petani Produk')]
#[Layout('layouts.sidebar')]

class Product extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $perPage = 10;

    // Modal properties
    public $showModal = false;
    public $showViewModal = false;
    public $editMode = false;
    public $selectedProduct = null;

    // Form properties
    public $productId;
    public $name;
    public $description;
    public $category_id;
    public $price;
    public $unit = 'kg';
    public $stock;
    public $image;
    public $existingImage;
    public $is_active = true;

    protected $queryString = ['search', 'categoryFilter', 'statusFilter'];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];

        if ($this->image) {
            $rules['image'] = 'image|max:2048'; // 2MB max
        }

        return $rules;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $product = ProductModel::where('petani_profile_id', Auth::user()->petaniProfile->id)
            ->findOrFail($id);
        
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->unit = $product->unit;
        $this->stock = $product->stock;
        $this->existingImage = $product->image_path;
        $this->is_active = $product->is_active;
        
        $this->editMode = true;
        $this->showModal = true;
    }

    public function openViewModal($id)
    {
        $this->selectedProduct = ProductModel::with('category')
            ->where('petani_profile_id', Auth::user()->petaniProfile->id)
            ->findOrFail($id);
        
        $this->showViewModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showViewModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'productId',
            'name',
            'description',
            'category_id',
            'price',
            'unit',
            'stock',
            'image',
            'existingImage',
            'is_active',
            'selectedProduct'
        ]);
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        $petaniProfile = Auth::user()->petaniProfile;

        if (!$petaniProfile) {
            $this->dispatch('product-error', message: 'Profil petani tidak ditemukan. Silakan lengkapi profil Anda.');
            return;
        }

        $data = [
            'petani_profile_id' => $petaniProfile->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'unit' => $this->unit,
            'stock' => $this->stock,
            'is_active' => $this->is_active,
        ];

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->editMode && $this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            
            $data['image_path'] = $this->image->store('products', 'public');
        }

        if ($this->editMode) {
            $product = ProductModel::where('petani_profile_id', $petaniProfile->id)
                ->findOrFail($this->productId);
            $product->update($data);
            $message = 'Produk berhasil diperbarui!';
        } else {
            ProductModel::create($data);
            $message = 'Produk berhasil ditambahkan!';
        }

        $this->closeModal();
        $this->dispatch('product-saved', message: $message);
    }

    public function delete($id)
    {
        $petaniProfile = Auth::user()->petaniProfile;
        $product = ProductModel::where('petani_profile_id', $petaniProfile->id)
            ->findOrFail($id);

        // Delete image if exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        $this->dispatch('product-deleted', message: 'Produk berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $petaniProfile = Auth::user()->petaniProfile;
        $product = ProductModel::where('petani_profile_id', $petaniProfile->id)
            ->findOrFail($id);
        
        $product->update(['is_active' => !$product->is_active]);
        
        $status = $product->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $this->dispatch('product-status-updated', message: "Produk berhasil {$status}!");
    }

    public function render()
    {
        $petaniProfile = Auth::user()->petaniProfile;
        
        $query = ProductModel::with('category')
            ->where('petani_profile_id', $petaniProfile->id ?? 0)
            ->orderBy('created_at', 'desc');

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Category filter
        if ($this->categoryFilter) {
            $query->where('category_id', $this->categoryFilter);
        }

        // Status filter
        if ($this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter);
        }

        $products = $query->paginate($this->perPage);
        $categories = Category::orderBy('name')->get();

        return view('livewire.petani.product', [
            'products' => $products,
            'categories' => $categories,
            'petaniProfile' => $petaniProfile,
        ]);
    }
}
