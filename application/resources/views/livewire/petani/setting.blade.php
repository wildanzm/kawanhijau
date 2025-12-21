<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Pengaturan</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola pengaturan akun dan informasi lahan pertanian Anda</p>
            </div>
        </div>
    </div>

    <!-- User Account Information -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h2 class="text-lg font-bold text-white">Informasi Akun</h2>
                </div>
                <button wire:click="openProfileModal"
                    class="px-4 py-2 bg-white text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-50 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Akun
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <tbody class="divide-y divide-zinc-200">
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nama Lengkap</td>
                        <td class="px-6 py-4 text-sm text-zinc-900">{{ $user->name }}</td>
                    </tr>
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Email</td>
                        <td class="px-6 py-4 text-sm text-zinc-900">{{ $user->email }}</td>
                    </tr>
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Role</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ ucfirst($user->roles->first()->name ?? 'Petani') }}
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Bergabung Sejak</td>
                        <td class="px-6 py-4 text-sm text-zinc-900">{{ $user->created_at->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Petani Profile Information -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-lg font-bold text-white">Informasi Lahan Pertanian</h2>
                </div>
                <button wire:click="openPetaniModal"
                    class="px-4 py-2 bg-white text-green-600 rounded-lg text-sm font-medium hover:bg-green-50 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ $petaniProfile ? 'Edit Lahan' : 'Lengkapi Data Lahan' }}
                </button>
            </div>
        </div>
        @if ($petaniProfile)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <tbody class="divide-y divide-zinc-200">
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nama Lahan</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">{{ $petaniProfile->farm_name ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Alamat</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">{{ $petaniProfile->address ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Kota</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">{{ $petaniProfile->city ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nomor Telepon</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">{{ $petaniProfile->phone_number ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Bio</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">{{ $petaniProfile->bio ?? '-' }}</td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Luas Lahan</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">
                                {{ $petaniProfile->farm_size ? number_format($petaniProfile->farm_size, 0, ',', '.') . ' m²' : '-' }}
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Pengalaman Bertani</td>
                            <td class="px-6 py-4 text-sm text-zinc-900">
                                @if ($petaniProfile->farming_experience)
                                    @switch($petaniProfile->farming_experience)
                                        @case('beginner')
                                            Pemula
                                        @break

                                        @case('intermediate')
                                            Menengah
                                        @break

                                        @case('experienced')
                                            Berpengalaman
                                        @break

                                        @case('expert')
                                            Ahli
                                        @break

                                        @default
                                            -
                                    @endswitch
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Status Verifikasi</td>
                            <td class="px-6 py-4">
                                @if ($petaniProfile->verification_status === 'approved')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @elseif($petaniProfile->verification_status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        <svg class="w-3 h-3 mr-1 animate-spin" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Menunggu Verifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Belum Diverifikasi
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-zinc-500 font-medium mb-2">Data lahan belum dilengkapi</p>
                <p class="text-xs text-zinc-400 mb-4">Lengkapi data lahan Anda untuk dapat mulai berjualan</p>
                <button wire:click="openPetaniModal"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                    Lengkapi Sekarang
                </button>
            </div>
        @endif
    </div>

    <!-- Security Settings -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-rose-500 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h2 class="text-lg font-bold text-white">Keamanan Akun</h2>
                </div>
                <button wire:click="openPasswordModal"
                    class="px-4 py-2 bg-white text-red-600 rounded-lg text-sm font-medium hover:bg-red-50 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    Ubah Password
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <tbody class="divide-y divide-zinc-200">
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Password</td>
                        <td class="px-6 py-4 text-sm text-zinc-900">••••••••••</td>
                    </tr>
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Terakhir Diubah</td>
                        <td class="px-6 py-4 text-sm text-zinc-900">
                            {{ $user->updated_at->translatedFormat('d F Y, H:i') }} WIB</td>
                    </tr>
                </tbody>
            </table>
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
                <!-- Background overlay with blur -->
                <div class="fixed inset-0 z-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="$wire.closeProfileModal()">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <form wire:submit="updateProfile">
                        <div
                            class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                            <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Informasi Akun
                            </h3>
                            <button type="button" wire:click="closeProfileModal"
                                class="text-zinc-400 hover:text-zinc-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="px-6 py-5 space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-zinc-700 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" id="name" wire:model="name"
                                    class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Email</label>
                                <input type="email" id="email" wire:model="email"
                                    class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    placeholder="Masukkan email">
                                @error('email')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-6 py-4 border-t border-zinc-200 bg-zinc-50 gap-3">
                            <button type="button" wire:click="closeProfileModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <svg wire:loading wire:target="updateProfile"
                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Edit Petani Profile -->
    @if ($showPetaniModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showPetaniModal') }" x-show="show"
            style="display: none;" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 z-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="$wire.closePetaniModal()">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <form wire:submit="updatePetaniProfile">
                        <div
                            class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-green-50 to-emerald-50">
                            <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $petaniProfile ? 'Edit Informasi Lahan' : 'Lengkapi Informasi Lahan' }}
                            </h3>
                            <button type="button" wire:click="closePetaniModal"
                                class="text-zinc-400 hover:text-zinc-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="farm_name" class="block text-sm font-semibold text-zinc-700 mb-2">Nama
                                        Lahan <span class="text-red-500">*</span></label>
                                    <input type="text" id="farm_name" wire:model="farm_name"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="Contoh: Kebun Sayur Segar">
                                    @error('farm_name')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="address"
                                        class="block text-sm font-semibold text-zinc-700 mb-2">Alamat Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <textarea id="address" wire:model="address" rows="3"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="Jalan, RT/RW, Kelurahan, Kecamatan"></textarea>
                                    @error('address')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-semibold text-zinc-700 mb-2">Kota
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="city" wire:model="city"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="Contoh: Bandung">
                                    @error('city')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone_number"
                                        class="block text-sm font-semibold text-zinc-700 mb-2">Nomor Telepon <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="phone_number" wire:model="phone_number"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="08xxxxxxxxxx">
                                    @error('phone_number')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="farm_size" class="block text-sm font-semibold text-zinc-700 mb-2">Luas
                                        Lahan (m²)</label>
                                    <input type="number" id="farm_size" wire:model="farm_size" step="0.01"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="Contoh: 1000">
                                    @error('farm_size')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="farming_experience"
                                        class="block text-sm font-semibold text-zinc-700 mb-2">Pengalaman
                                        Bertani</label>
                                    <select id="farming_experience" wire:model="farming_experience"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                                        <option value="">Pilih Level Pengalaman</option>
                                        <option value="beginner">Pemula</option>
                                        <option value="intermediate">Menengah</option>
                                        <option value="experienced">Berpengalaman</option>
                                        <option value="expert">Ahli</option>
                                    </select>
                                    @error('farming_experience')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="bio" class="block text-sm font-semibold text-zinc-700 mb-2">Bio /
                                        Deskripsi</label>
                                    <textarea id="bio" wire:model="bio" rows="4"
                                        class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                        placeholder="Ceritakan tentang lahan dan pengalaman bertani Anda..."></textarea>
                                    @error('bio')
                                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-6 py-4 border-t border-zinc-200 bg-zinc-50 gap-3">
                            <button type="button" wire:click="closePetaniModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                                <svg wire:loading wire:target="updatePetaniProfile"
                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Simpan Perubahan
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
                <div class="fixed inset-0 z-0 bg-zinc-900/50 backdrop-blur-sm transition-opacity"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    @click="$wire.closePasswordModal()">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <form wire:submit="updatePassword">
                        <div
                            class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-red-50 to-rose-50">
                            <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
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

                        <div class="px-6 py-5 space-y-4">
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                                <p class="text-xs text-amber-800">
                                    <span class="font-semibold">Catatan:</span> Password harus minimal 8 karakter.
                                </p>
                            </div>

                            <div>
                                <label for="current_password"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Password Saat Ini</label>
                                <input type="password" id="current_password" wire:model="current_password"
                                    class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                    placeholder="Masukkan password saat ini">
                                @error('current_password')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Password Baru</label>
                                <input type="password" id="new_password" wire:model="new_password"
                                    class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                    placeholder="Masukkan password baru">
                                @error('new_password')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password_confirmation"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Konfirmasi Password
                                    Baru</label>
                                <input type="password" id="new_password_confirmation"
                                    wire:model="new_password_confirmation"
                                    class="block w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                                    placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-6 py-4 border-t border-zinc-200 bg-zinc-50 gap-3">
                            <button type="button" wire:click="closePasswordModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                <svg wire:loading wire:target="updatePassword"
                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @script
        <script>
            $wire.on('profile-updated', () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Informasi akun berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });

            $wire.on('petani-profile-updated', () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Informasi lahan berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });

            $wire.on('password-updated', () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Password berhasil diubah!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endscript
</div>
