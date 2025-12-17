<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Pengaturan Akun</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
            </div>
            <div class="flex items-center space-x-2">
                <div
                    class="px-3 py-1.5 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-lg border border-primary-200">
                    <span class="text-xs font-semibold text-primary-700">Admin</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Profil
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <tbody class="divide-y divide-zinc-200">
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4 w-1/3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Nama Lengkap</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-sm text-zinc-900 font-medium">{{ $user->name }}</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Email</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-sm text-zinc-900 font-medium">{{ $user->email }}</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Role</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    @foreach ($user->roles as $role)
                                        {{ ucfirst($role->name) }}
                                    @endforeach
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Bergabung Sejak</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="text-sm text-zinc-900 font-medium">{{ $user->created_at->translatedFormat('d F Y') }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-6 border-t border-zinc-200">
                <button wire:click="openProfileModal"
                    class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Profil</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Security Settings Card -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Keamanan Akun
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <tbody class="divide-y divide-zinc-200">
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4 w-1/3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Password</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-sm text-zinc-900 font-medium">••••••••</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-zinc-600">Terakhir Diubah</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="text-sm text-zinc-900 font-medium">{{ $user->updated_at->diffForHumans() }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-6 border-t border-zinc-200">
                <button wire:click="openPasswordModal"
                    class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <span>Ubah Password</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    @if ($showProfileModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showProfileModal') }" x-show="show"
            style="display: none;" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 z-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="$wire.closeProfileModal()">
                </div>

                <!-- Center alignment helper -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <!-- Modal Header -->
                    <div
                        class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                        <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profil
                        </h3>
                        <button type="button" wire:click="closeProfileModal"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit.prevent="updateProfile" class="px-6 py-5">
                        <div class="space-y-4">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-zinc-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="name" wire:model="name"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Email</label>
                                <input type="email" id="email" wire:model="email"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                                    placeholder="Masukkan email">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                            <button type="button" wire:click="closeProfileModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Change Password -->
    @if ($showPasswordModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showPasswordModal') }" x-show="show"
            style="display: none;" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 z-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="$wire.closePasswordModal()">
                </div>

                <!-- Center alignment helper -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <!-- Modal Header -->
                    <div
                        class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-red-50 to-orange-50">
                        <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Ubah Password
                        </h3>
                        <button type="button" wire:click="closePasswordModal"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit.prevent="updatePassword" class="px-6 py-5">
                        <div class="space-y-4">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Password Saat Ini</label>
                                <input type="password" id="current_password" wire:model="current_password"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('current_password') border-red-500 @enderror"
                                    placeholder="Masukkan password saat ini">
                                @error('current_password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="new_password"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Password
                                    Baru</label>
                                <input type="password" id="new_password" wire:model="new_password"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all @error('new_password') border-red-500 @enderror"
                                    placeholder="Masukkan password baru (min. 8 karakter)">
                                @error('new_password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label for="new_password_confirmation"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Konfirmasi Password
                                    Baru</label>
                                <input type="password" id="new_password_confirmation"
                                    wire:model="new_password_confirmation"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                    placeholder="Ulangi password baru">
                            </div>

                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                                <p class="text-xs text-amber-800 flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Password harus minimal 8 karakter dan disarankan menggunakan kombinasi huruf,
                                        angka, dan simbol.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                            <button type="button" wire:click="closePasswordModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-orange-500 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Ubah Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('profile-updated', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: event.message,
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });

            Livewire.on('password-updated', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: event.message,
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });
        });
    </script>
@endpush
