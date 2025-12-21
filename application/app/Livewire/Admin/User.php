<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User as ModelUser;
use Livewire\Attributes\On;

#[Title('KawanHijau | Admin Pengguna')]
#[Layout('layouts.sidebar')]

class User extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = 'all'; // all, user, petani
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Modal properties
    public $showModal = false;
    public $modalMode = 'create'; // create, edit, view
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;

    // Delete confirmation
    public $showDeleteModal = false;
    public $deleteUserId;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => 'all'],
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:user,petani',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
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
    public function openEditModal($id)
    {
        $user = ModelUser::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
        $this->modalMode = 'edit';
        $this->showModal = true;
    }

    public function openViewModal($id)
    {
        $user = ModelUser::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();
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
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|in:user,petani',
        ];

        if ($this->password) {
            $rules['password'] = 'min:8|confirmed';
        }

        $this->validate($rules);

        $user = ModelUser::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $user->update(['password' => bcrypt($this->password)]);
        }

        $user->syncRoles([$this->role]);

        session()->flash('message', 'Pengguna berhasil diperbarui!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteUserId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $user = ModelUser::findOrFail($this->deleteUserId);
        $user->delete();

        $this->showDeleteModal = false;
        $this->deleteUserId = null;

        session()->flash('message', 'Pengguna berhasil dihapus!');
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteUserId = null;
    }

    public function verifyPetani($userId)
    {
        $user = ModelUser::findOrFail($userId);
        
        if (!$user->hasRole('petani') || !$user->petaniProfile) {
            session()->flash('error', 'Pengguna bukan petani atau profil tidak ditemukan!');
            return;
        }

        $user->petaniProfile->update([
            'verification_status' => 'approved'
        ]);

        session()->flash('message', 'Petani berhasil diverifikasi!');
    }

    public function rejectPetani($userId)
    {
        $user = ModelUser::findOrFail($userId);
        
        if (!$user->hasRole('petani') || !$user->petaniProfile) {
            session()->flash('error', 'Pengguna bukan petani atau profil tidak ditemukan!');
            return;
        }

        $user->petaniProfile->update([
            'verification_status' => 'rejected'
        ]);

        session()->flash('message', 'Verifikasi petani ditolak!');
    }

    public function render()
    {
        // Build base query
        $query = ModelUser::with('petaniProfile');

        // Filter by role first
        if ($this->roleFilter === 'user') {
            $query->role('user');
        } elseif ($this->roleFilter === 'petani') {
            $query->role('petani');
        } else {
            // Show all users with either 'user' or 'petani' role
            $query->where(function($q) {
                $q->whereHas('roles', function($roleQuery) {
                    $roleQuery->where('name', 'user');
                })->orWhereHas('roles', function($roleQuery) {
                    $roleQuery->where('name', 'petani');
                });
            });
        }

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        // Get paginated results
        $allUsers = $query->paginate($this->perPage);

        // Separate into groups for display
        $users = collect();
        $petani = collect();

        if ($this->roleFilter === 'all' || $this->roleFilter === 'user') {
            foreach ($allUsers as $user) {
                if ($user->hasRole('user')) {
                    $users->push($user);
                }
            }
        }

        if ($this->roleFilter === 'all' || $this->roleFilter === 'petani') {
            foreach ($allUsers as $user) {
                if ($user->hasRole('petani')) {
                    $petani->push($user);
                }
            }
        }

        return view('livewire.admin.user', [
            'users' => $users,
            'petani' => $petani,
            'allUsers' => $allUsers,
            'totalUsers' => ModelUser::role('user')->count(),
            'totalPetani' => ModelUser::role('petani')->count(),
        ]);
    }
}
