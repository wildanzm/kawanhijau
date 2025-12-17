<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Str;

#[Title('KawanHijau | Admin Kategori')]
#[Layout('layouts.sidebar')]
class Category extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Modal properties
    public $showModal = false;
    public $modalMode = 'create'; // create, edit
    public $categoryId;
    public $name;
    public $slug;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if ($this->modalMode === 'create') {
            $rules['slug'] = 'required|string|max:255|unique:categories,slug';
        } else {
            $rules['slug'] = 'required|string|max:255|unique:categories,slug,' . $this->categoryId;
        }

        return $rules;
    }

    public function updatingSearch()
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

    // Auto generate slug from name
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
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
        $category = CategoryModel::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->modalMode = 'edit';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->modalMode === 'create') {
            CategoryModel::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            $this->dispatch('category-saved', message: 'Kategori berhasil ditambahkan!');
        } elseif ($this->modalMode === 'edit') {
            $category = CategoryModel::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);

            $this->dispatch('category-saved', message: 'Kategori berhasil diperbarui!');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $category = CategoryModel::findOrFail($id);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            $this->dispatch('category-error', message: 'Kategori tidak dapat dihapus karena masih memiliki produk!');
            return;
        }

        $category->delete();
        $this->dispatch('category-deleted', message: 'Kategori berhasil dihapus!');
    }

    public function render()
    {
        $categories = CategoryModel::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->withCount('products')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.category', [
            'categories' => $categories,
            'totalCategories' => CategoryModel::count(),
        ]);
    }
}
