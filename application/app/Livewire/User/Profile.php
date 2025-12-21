<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Title('KawanHijau | Profil Saya')]
#[Layout('layouts.main')]

class Profile extends Component
{
    // User data
    public $name = '';
    public $email = '';

    // Password change
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    // Modals
    public $showProfileModal = false;
    public $showPasswordModal = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function openProfileModal()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->showProfileModal = true;
    }

    public function closeProfileModal()
    {
        $this->showProfileModal = false;
        $this->resetErrorBag();
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->showProfileModal = false;
        $this->dispatch('profile-updated');
    }

    public function openPasswordModal()
    {
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->showPasswordModal = true;
    }

    public function closePasswordModal()
    {
        $this->showPasswordModal = false;
        $this->resetErrorBag();
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->showPasswordModal = false;
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->dispatch('password-updated');
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.user.profile', [
            'user' => $user,
        ]);
    }
}
