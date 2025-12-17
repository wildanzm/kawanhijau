<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use App\Models\Category;
use App\Models\PetaniProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Title('KawanHijau | Admin Produk')]
#[Layout('layouts.sidebar')]
class Product extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Modal properties
    public $showModal = false;
    public $modalMode = 'create'; // create, edit, view
    public $productId;
    public $petani_profile_id;
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $unit = 'kg';
    public $stock;
    public $image_path;
    public $image;
    public $is_active = true;

    // View mode
    public $viewProduct;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    protected function rules()
    {
        $rules = [
            'petani_profile_id' => 'required|exists:petani_profiles,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];

        if ($this->modalMode === 'create') {
            $rules['image'] = 'required|image|max:2048'; // 2MB
        } else {
            $rules['image'] = 'nullable|image|max:2048';
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

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Modal methods
    public function openCreateModal()
    {
        $this->resetForm();
        $this->modalMode = 'create';
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $product = ProductModel::findOrFail($id);
        $this->productId = $product->id;
        $this->petani_profile_id = $product->petani_profile_id;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->unit = $product->unit;
        $this->stock = $product->stock;
        $this->image_path = $product->image_path;
        $this->is_active = $product->is_active;
        $this->modalMode = 'edit';
        $this->showModal = true;
    }

    public function openViewModal($id)
    {
        $this->viewProduct = ProductModel::with(['category', 'petaniProfile.user'])->findOrFail($id);
        $this->modalMode = 'view';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->productId = null;
        $this->petani_profile_id = null;
        $this->category_id = null;
        $this->name = '';
        $this->description = '';
        $this->price = null;
        $this->unit = 'kg';
        $this->stock = null;
        $this->image_path = null;
        $this->image = null;
        $this->is_active = true;
        $this->viewProduct = null;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'petani_profile_id' => $this->petani_profile_id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'unit' => $this->unit,
            'stock' => $this->stock,
            'is_active' => $this->is_active,
        ];

        // Handle image upload
        if ($this->image) {
            $imageName = Str::slug($this->name) . '-' . time() . '.' . $this->image->extension();
            $imagePath = $this->image->storeAs('products', $imageName, 'public');
            $data['image_path'] = $imagePath;

            // Delete old image if editing
            if ($this->modalMode === 'edit' && $this->image_path) {
                Storage::disk('public')->delete($this->image_path);
            }
        }

        if ($this->modalMode === 'create') {
            ProductModel::create($data);
            $this->dispatch('product-saved', message: 'Produk berhasil ditambahkan!');
        } elseif ($this->modalMode === 'edit') {
            $product = ProductModel::findOrFail($this->productId);
            $product->update($data);
            $this->dispatch('product-saved', message: 'Produk berhasil diperbarui!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $product = ProductModel::findOrFail($id);
        
        // Delete image
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
        $this->dispatch('product-deleted', message: 'Produk berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $product = ProductModel::findOrFail($id);
        $product->update(['is_active' => !$product->is_active]);
        $this->dispatch('product-saved', message: 'Status produk berhasil diperbarui!');
    }

    public function render()
    {
        $products = ProductModel::query()
            ->with(['category', 'petaniProfile.user'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter !== '', function ($query) {
                $query->where('is_active', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();
        $petaniProfiles = PetaniProfile::with('user')->get();
        $totalProducts = ProductModel::count();
        $activeProducts = ProductModel::where('is_active', true)->count();

        return view('livewire.admin.product', [
            'products' => $products,
            'categories' => $categories,
            'petaniProfiles' => $petaniProfiles,
            'totalProducts' => $totalProducts,
            'activeProducts' => $activeProducts,
        ]);
    }
}
