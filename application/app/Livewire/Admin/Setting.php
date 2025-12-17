<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Title('KawanHijau | Admin Pengaturan')]
#[Layout('layouts.sidebar')]

class Setting extends Component
{
    // Profile properties
    public $name;
    public $email;
    
    // Password properties
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    
    // Modal states
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
        $this->showProfileModal = true;
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function closeProfileModal()
    {
        $this->showProfileModal = false;
        $this->reset(['name', 'email']);
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->closeProfileModal();
        $this->dispatch('profile-updated', message: 'Profil berhasil diperbarui!');
    }

    public function openPasswordModal()
    {
        $this->showPasswordModal = true;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function closePasswordModal()
    {
        $this->showPasswordModal = false;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->closePasswordModal();
        $this->dispatch('password-updated', message: 'Password berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.setting', [
            'user' => Auth::user()
        ]);
    }
}
