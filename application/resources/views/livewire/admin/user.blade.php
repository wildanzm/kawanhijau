<div>
    <!-- Header Section -->
    <div class="mb-6">
        <!-- Alert Notifikasi -->
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Daftar Pengguna</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola semua pengguna dan petani di platform KawanHijau</p>
            </div>
            <div class="flex items-center space-x-2">
                <div
                    class="px-4 py-2 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-600 font-medium">Total Pengguna</p>
                            <p class="text-lg font-bold text-blue-900">{{ number_format($totalUsers) }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="px-4 py-2 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div>
                            <p class="text-xs text-green-600 font-medium">Total Petani</p>
                            <p class="text-lg font-bold text-green-900">{{ number_format($totalPetani) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Group (Pengguna) -->
    @if ($roleFilter === 'all' || $roleFilter === 'user')
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
            <!-- Group Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Pengguna</h3>
                            <p class="text-sm text-blue-100">{{ number_format($totalUsers) }} pengguna terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                <button wire:click="sortBy('name')"
                                    class="flex items-center space-x-1 hover:text-zinc-900">
                                    <span>Nama</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                <button wire:click="sortBy('created_at')"
                                    class="flex items-center space-x-1 hover:text-zinc-900">
                                    <span>Bergabung</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200">
                        @forelse($users as $user)
                            <tr wire:key="user-{{ $user->id }}" class="hover:bg-zinc-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-zinc-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zinc-600">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                                    {{ $user->created_at->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="text-zinc-500 font-medium">Tidak ada pengguna ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden divide-y divide-zinc-200">
                @forelse($users as $user)
                    <div wire:key="user-mobile-{{ $user->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-900">{{ $user->name }}</h4>
                                <p class="text-xs text-zinc-600 mt-0.5">{{ $user->email }}</p>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-zinc-500 mb-3">
                            <span>Bergabung: {{ $user->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <p class="text-zinc-500 font-medium">Tidak ada pengguna ditemukan</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Petani Group -->
    @if ($roleFilter === 'all' || $roleFilter === 'petani')
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
            <!-- Group Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Petani</h3>
                            <p class="text-sm text-green-100">{{ number_format($totalPetani) }} petani terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Nama
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Status Verifikasi
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Bergabung
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200">
                        @forelse($petani as $farmer)
                            <tr wire:key="petani-{{ $farmer->id }}" class="hover:bg-zinc-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-zinc-900">{{ $farmer->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zinc-600">{{ $farmer->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($farmer->petaniProfile)
                                        @if ($farmer->petaniProfile->verification_status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Terverifikasi
                                            </span>
                                        @elseif($farmer->petaniProfile->verification_status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Menunggu
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Ditolak
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-xs text-zinc-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                                    {{ $farmer->created_at->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if ($farmer->petaniProfile && $farmer->petaniProfile->verification_status === 'pending')
                                            <button wire:click="verifyPetani({{ $farmer->id }})"
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                title="Verifikasi">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                            <button wire:click="rejectPetani({{ $farmer->id }})"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Tolak">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <p class="text-zinc-500 font-medium">Tidak ada petani ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden divide-y divide-zinc-200">
                @forelse($petani as $farmer)
                    <div wire:key="petani-mobile-{{ $farmer->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-900">{{ $farmer->name }}</h4>
                                <p class="text-xs text-zinc-600 mt-0.5">{{ $farmer->email }}</p>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                        <div class="mb-3">
                            @if ($farmer->petaniProfile)
                                <div class="flex items-center justify-between text-xs mb-2">
                                    <span class="text-zinc-600">Status Verifikasi:</span>
                                    @if ($farmer->petaniProfile->verification_status === 'approved')
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Terverifikasi
                                        </span>
                                    @elseif($farmer->petaniProfile->verification_status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Menunggu
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-xs text-zinc-500 mb-3">
                            <span>Bergabung: {{ $farmer->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        @if ($farmer->petaniProfile && $farmer->petaniProfile->verification_status === 'pending')
                            <div class="flex items-center space-x-2">
                                <button wire:click="verifyPetani({{ $farmer->id }})"
                                    class="flex-1 px-3 py-2 bg-green-50 text-green-600 rounded-lg text-xs font-medium hover:bg-green-100 transition-colors flex items-center justify-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Verifikasi</span>
                                </button>
                                <button wire:click="rejectPetani({{ $farmer->id }})"
                                    class="flex-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition-colors flex items-center justify-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Tolak</span>
                                </button>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <p class="text-zinc-500 font-medium">Tidak ada petani ditemukan</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Pagination -->
    @if (isset($allUsers) && $allUsers->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $allUsers->links() }}
        </div>
    @endif

    <!-- Modal Create/Edit User -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity bg-zinc-900 bg-opacity-75" @click="$wire.closeModal()">
                </div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <!-- Modal Header -->
                    <div
                        class="bg-gradient-to-r {{ $modalMode === 'view' ? 'from-blue-500 to-blue-600' : 'from-primary-500 to-secondary-500' }} px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">
                                @if ($modalMode === 'edit')
                                    Edit Pengguna
                                @else
                                    Detail Pengguna
                                @endif
                            </h3>
                            <button wire:click="closeModal" class="text-white hover:text-zinc-200 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-6">
                        @if ($modalMode === 'view')
                            <!-- View Mode -->
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-semibold text-zinc-700">Nama Lengkap</label>
                                    <p class="mt-1 text-zinc-900">{{ $name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-zinc-700">Email</label>
                                    <p class="mt-1 text-zinc-900">{{ $email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-zinc-700">Role</label>
                                    <p class="mt-1">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $role === 'petani' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $role === 'petani' ? 'Petani' : 'Pengguna' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @else
                            <!-- Create/Edit Mode -->
                            <form wire:submit.prevent="save" class="space-y-4">
                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" wire:model="name"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                        placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" wire:model="email"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                        placeholder="contoh@email.com">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div>
                                    <label for="role" class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Role <span class="text-red-500">*</span>
                                    </label>
                                    <select id="role" wire:model="role"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                        <option value="">Pilih Role</option>
                                        <option value="user">Pengguna</option>
                                        <option value="petani">Petani</option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Password
                                        <span class="text-zinc-500 text-xs font-normal">(Kosongkan jika tidak ingin
                                            mengubah)</span>
                                    </label>
                                    <input type="password" id="password" wire:model="password"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                        placeholder="Minimal 8 karakter">
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Konfirmasi Password
                                    </label>
                                    <input type="password" id="password_confirmation"
                                        wire:model="password_confirmation"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                        placeholder="Ulangi password">
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button type="button" wire:click="closeModal"
                                        class="px-4 py-2.5 bg-zinc-100 text-zinc-700 rounded-lg hover:bg-zinc-200 transition-colors font-medium">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2.5 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                    <!-- View Mode Footer -->
                    @if ($modalMode === 'view')
                        <div class="px-6 py-4 bg-zinc-50 border-t border-zinc-200">
                            <div class="flex justify-end">
                                <button wire:click="closeModal"
                                    class="px-4 py-2.5 bg-zinc-600 text-white rounded-lg hover:bg-zinc-700 transition-colors font-medium">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDeleteModal') }" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity bg-zinc-900 bg-opacity-75" @click="$wire.cancelDelete()">
                </div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <!-- Modal Content -->
                    <div class="px-6 py-6">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900 text-center mb-2">
                            Hapus Pengguna?
                        </h3>
                        <p class="text-sm text-zinc-600 text-center mb-6">
                            Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
                        </p>

                        <!-- Buttons -->
                        <div class="flex space-x-3">
                            <button wire:click="cancelDelete"
                                class="flex-1 px-4 py-2.5 bg-zinc-100 text-zinc-700 rounded-lg hover:bg-zinc-200 transition-colors font-medium">
                                Batal
                            </button>
                            <button wire:click="delete"
                                class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                Ya, Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
