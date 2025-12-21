<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\PetaniProfile;

#[Title('KawanHijau | Petani Pengaturan')]
#[Layout('layouts.sidebar')]

class Setting extends Component
{
    use WithFileUploads;

    // User data
    public $name = '';
    public $email = '';

    // Petani Profile data
    public $farm_name = '';
    public $address = '';
    public $city = '';
    public $phone_number = '';
    public $bio = '';
    public $farm_size = '';
    public $farming_experience = '';

    // Password change
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    // Modals
    public $showProfileModal = false;
    public $showPetaniModal = false;
    public $showPasswordModal = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        $petaniProfile = $user->petaniProfile;
        if ($petaniProfile) {
            $this->farm_name = $petaniProfile->farm_name ?? '';
            $this->address = $petaniProfile->address ?? '';
            $this->city = $petaniProfile->city ?? '';
            $this->phone_number = $petaniProfile->phone_number ?? '';
            $this->bio = $petaniProfile->bio ?? '';
            $this->farm_size = $petaniProfile->farm_size ?? '';
            $this->farming_experience = $petaniProfile->farming_experience ?? '';
        }
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

    public function openPetaniModal()
    {
        $petaniProfile = Auth::user()->petaniProfile;
        if ($petaniProfile) {
            $this->farm_name = $petaniProfile->farm_name ?? '';
            $this->address = $petaniProfile->address ?? '';
            $this->city = $petaniProfile->city ?? '';
            $this->phone_number = $petaniProfile->phone_number ?? '';
            $this->bio = $petaniProfile->bio ?? '';
            $this->farm_size = $petaniProfile->farm_size ?? '';
            $this->farming_experience = $petaniProfile->farming_experience ?? '';
        }
        $this->showPetaniModal = true;
    }

    public function closePetaniModal()
    {
        $this->showPetaniModal = false;
        $this->resetErrorBag();
    }

    public function updatePetaniProfile()
    {
        $this->validate([
            'farm_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'farm_size' => 'nullable|numeric|min:0',
            'farming_experience' => 'nullable|in:beginner,intermediate,experienced,expert',
        ], [
            'farm_name.required' => 'Nama lahan wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'city.required' => 'Kota wajib diisi.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'farm_size.numeric' => 'Luas lahan harus berupa angka.',
            'farming_experience.in' => 'Level pengalaman tidak valid.',
        ]);

        $user = Auth::user();
        $petaniProfile = $user->petaniProfile;

        if ($petaniProfile) {
            $petaniProfile->update([
                'farm_name' => $this->farm_name,
                'address' => $this->address,
                'city' => $this->city,
                'phone_number' => $this->phone_number,
                'bio' => $this->bio,
                'farm_size' => $this->farm_size,
                'farming_experience' => $this->farming_experience,
            ]);
        } else {
            PetaniProfile::create([
                'user_id' => $user->id,
                'farm_name' => $this->farm_name,
                'address' => $this->address,
                'city' => $this->city,
                'phone_number' => $this->phone_number,
                'bio' => $this->bio,
                'farm_size' => $this->farm_size,
                'farming_experience' => $this->farming_experience,
            ]);
        }

        $this->showPetaniModal = false;
        $this->dispatch('petani-profile-updated');
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
        $petaniProfile = $user->petaniProfile;

        return view('livewire.petani.setting', [
            'user' => $user,
            'petaniProfile' => $petaniProfile,
        ]);
    }
}
