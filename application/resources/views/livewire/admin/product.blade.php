<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Daftar Produk</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola produk dari semua toko di platform KawanHijau</p>
            </div>
            <div class="flex items-center space-x-2">
                <div
                    class="px-4 py-2 bg-gradient-to-br from-primary-50 to-secondary-50 rounded-xl border border-primary-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <div>
                            <p class="text-xs text-primary-600 font-medium">Total Produk</p>
                            <p class="text-lg font-bold text-primary-900">{{ number_format($totalProducts) }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="px-4 py-2 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-xs text-green-600 font-medium">Produk Aktif</p>
                            <p class="text-lg font-bold text-green-900">{{ number_format($activeProducts) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-4 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="block w-full pl-10 pr-3 py-2.5 border border-zinc-300 rounded-lg text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                        placeholder="Cari nama atau deskripsi produk...">
                    <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="animate-spin h-5 w-5 text-primary-500" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <select wire:model.live="categoryFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select wire:model.live="statusFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
                <button wire:click="openCreateModal"
                    class="px-4 py-2 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="font-medium">Tambah Produk</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            <button wire:click="sortBy('price')"
                                class="flex items-center space-x-1 hover:text-zinc-900">
                                <span>Harga</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            <button wire:click="sortBy('stock')"
                                class="flex items-center space-x-1 hover:text-zinc-900">
                                <span>Stok</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($products as $product)
                        <tr wire:key="product-{{ $product->id }}" class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if ($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                            class="w-12 h-12 rounded-lg object-cover border-2 border-zinc-200">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-zinc-200 to-zinc-300 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-zinc-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-zinc-900 truncate">{{ $product->name }}
                                        </p>
                                        <p class="text-xs text-zinc-500 truncate">
                                            {{ Str::limit($product->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-100 text-primary-800">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-xs mr-2">
                                        {{ strtoupper(substr($product->petaniProfile->farm_name, 0, 2)) }}</div>
                                    <div>
                                        <p class="text-sm font-medium text-zinc-900">
                                            {{ $product->petaniProfile->farm_name }}</p>
                                        <p class="text-xs text-zinc-500">{{ $product->petaniProfile->user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-zinc-900">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">per {{ $product->unit }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">{{ number_format($product->stock) }}
                                    {{ $product->unit }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleStatus({{ $product->id }})"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $product->is_active ? 'bg-green-500' : 'bg-zinc-300' }}">
                                    <span
                                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $product->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <button wire:click="openViewModal({{ $product->id }})"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button wire:click="openEditModal({{ $product->id }})"
                                        class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="text-zinc-500 font-medium">Tidak ada produk ditemukan</p>
                                    <button wire:click="openCreateModal"
                                        class="mt-4 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm">Tambah
                                        Produk Pertama</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden divide-y divide-zinc-200">
            @forelse($products as $product)
                <div wire:key="product-mobile-{{ $product->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                    <div class="flex space-x-3 mb-3">
                        @if ($product->image_path)
                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                class="w-20 h-20 rounded-lg object-cover border-2 border-zinc-200">
                        @else
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-zinc-200 to-zinc-300 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-zinc-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-zinc-900">{{ $product->name }}</h4>
                            <p class="text-xs text-zinc-600 mt-1 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span
                                    class="text-xs px-2 py-0.5 bg-primary-100 text-primary-800 rounded">{{ $product->category->name }}</span>
                                <button wire:click="toggleStatus({{ $product->id }})"
                                    class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $product->is_active ? 'bg-green-500' : 'bg-zinc-300' }}">
                                    <span
                                        class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform {{ $product->is_active ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-sm font-bold text-zinc-900">Rp
                                {{ number_format($product->price, 0, ',', '.') }}<span
                                    class="text-xs font-normal text-zinc-500">/{{ $product->unit }}</span></p>
                            <p class="text-xs text-zinc-600">Stok: {{ number_format($product->stock) }}
                                {{ $product->unit }}</p>
                        </div>
                        <p class="text-xs text-zinc-600">{{ $product->petaniProfile->farm_name }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button wire:click="openViewModal({{ $product->id }})"
                            class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100 transition-colors">Lihat</button>
                        <button wire:click="openEditModal({{ $product->id }})"
                            class="flex-1 px-3 py-2 bg-amber-50 text-amber-600 rounded-lg text-xs font-medium hover:bg-amber-100 transition-colors">Edit</button>
                        <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                            class="flex-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-medium hover:bg-red-100 transition-colors">Hapus</button>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <p class="text-zinc-500 font-medium mb-4">Tidak ada produk ditemukan</p>
                    <button wire:click="openCreateModal"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm">Tambah
                        Produk Pertama</button>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200">{{ $products->links() }}</div>
        @endif
    </div>

    <!-- Modal Form (Create/Edit) -->
    @if ($showModal && $modalMode !== 'view')
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }" x-show="show"
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
                    @click="$wire.closeModal()">
                </div>

                <!-- Center alignment helper -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <form wire:submit.prevent="save">
                        <!-- Modal Header -->
                        <div
                            class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-primary-50 to-secondary-50">
                            <div>
                                <h3 class="text-lg font-bold text-zinc-900">
                                    {{ $modalMode === 'create' ? 'Tambah Produk Baru' : 'Edit Produk' }}</h3>
                                <p class="text-sm text-zinc-600 mt-0.5">
                                    {{ $modalMode === 'create' ? 'Lengkapi form di bawah untuk menambahkan produk baru' : 'Ubah informasi produk sesuai kebutuhan' }}
                                </p>
                            </div>
                            <button type="button" wire:click="closeModal"
                                class="p-2 text-zinc-400 hover:text-zinc-600 hover:bg-white rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-5 max-h-[calc(100vh-250px)] overflow-y-auto">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Nama Produk -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Nama Produk <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model="name"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                                        placeholder="Contoh: Tomat Cherry Segar">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Kategori <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model="category_id"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('category_id') border-red-500 @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Toko/Petani -->
                                <div>
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Toko <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model="petani_profile_id"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('petani_profile_id') border-red-500 @enderror">
                                        <option value="">Pilih Toko</option>
                                        @foreach ($petaniProfiles as $profile)
                                            <option value="{{ $profile->id }}">{{ $profile->farm_name }} -
                                                {{ $profile->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('petani_profile_id')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Harga -->
                                <div>
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Harga <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-zinc-500 text-sm font-medium">Rp</span>
                                        </div>
                                        <input type="number" wire:model="price"
                                            class="w-full pl-10 pr-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('price') border-red-500 @enderror"
                                            placeholder="50000" min="0">
                                    </div>
                                    @error('price')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Satuan -->
                                <div>
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Satuan <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model="unit"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('unit') border-red-500 @enderror"
                                        placeholder="kg, buah, ikat, dll">
                                    @error('unit')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Stok -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Stok <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" wire:model="stock"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('stock') border-red-500 @enderror"
                                        placeholder="100" min="0">
                                    @error('stock')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Deskripsi <span
                                            class="text-red-500">*</span></label>
                                    <textarea wire:model="description" rows="4"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none @error('description') border-red-500 @enderror"
                                        placeholder="Deskripsikan produk dengan detail..."></textarea>
                                    @error('description')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gambar Produk -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-zinc-700 mb-2">
                                        Gambar Produk
                                        @if ($modalMode === 'create')
                                            <span class="text-red-500">*</span>
                                        @endif
                                        <span class="text-xs text-zinc-500 font-normal">(Maksimal 2MB)</span>
                                    </label>

                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                                    class="w-32 h-32 rounded-lg object-cover border-2 border-primary-300 shadow-md">
                                            @elseif ($image_path)
                                                <img src="{{ Storage::url($image_path) }}" alt="Current Image"
                                                    class="w-32 h-32 rounded-lg object-cover border-2 border-zinc-300">
                                            @else
                                                <div
                                                    class="w-32 h-32 bg-gradient-to-br from-zinc-100 to-zinc-200 rounded-lg flex items-center justify-center border-2 border-dashed border-zinc-300">
                                                    <svg class="w-12 h-12 text-zinc-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" wire:model="image" accept="image/*"
                                                id="imageInput" class="hidden">
                                            <label for="imageInput"
                                                class="inline-flex items-center px-4 py-2.5 bg-white border border-zinc-300 rounded-lg cursor-pointer hover:bg-zinc-50 transition-colors">
                                                <svg class="w-5 h-5 text-zinc-600 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <span class="text-sm font-medium text-zinc-700">Pilih Gambar</span>
                                            </label>
                                            <p class="mt-2 text-xs text-zinc-500">Format: JPG, PNG, JPEG</p>
                                            <div wire:loading wire:target="image"
                                                class="mt-2 flex items-center text-primary-600">
                                                <svg class="animate-spin h-4 w-4 mr-2"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                <span class="text-xs">Uploading...</span>
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="md:col-span-2">
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" wire:model="is_active"
                                            class="w-5 h-5 text-primary-600 border-zinc-300 rounded focus:ring-2 focus:ring-primary-500">
                                        <span class="text-sm font-semibold text-zinc-700">Aktifkan Produk</span>
                                    </label>
                                    <p class="ml-8 text-xs text-zinc-500">Produk aktif akan ditampilkan di katalog</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div
                            class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                            <button type="button" wire:click="closeModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Batal</button>
                            <button type="submit" wire:loading.attr="disabled"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-500 to-secondary-500 rounded-lg hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-2">
                                <span wire:loading.remove
                                    wire:target="save">{{ $modalMode === 'create' ? 'Simpan Produk' : 'Update Produk' }}</span>
                                <span wire:loading wire:target="save" class="flex items-center">
                                    <svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Menyimpan...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal View Detail -->
    @if ($showModal && $modalMode === 'view' && $viewProduct)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }" x-show="show"
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
                    @click="$wire.closeModal()">
                </div>

                <!-- Center alignment helper -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.stop>

                    <!-- Modal Header -->
                    <div
                        class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                        <div>
                            <h3 class="text-lg font-bold text-zinc-900">Detail Produk</h3>
                            <p class="text-sm text-zinc-600 mt-0.5">Informasi lengkap tentang produk</p>
                        </div>
                        <button type="button" wire:click="closeModal"
                            class="p-2 text-zinc-400 hover:text-zinc-600 hover:bg-white rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-5 max-h-[calc(100vh-200px)] overflow-y-auto">
                        <!-- Product Image & Basic Info -->
                        <div class="flex flex-col sm:flex-row gap-6 mb-6">
                            <div class="flex-shrink-0">
                                @if ($viewProduct->image_path)
                                    <img src="{{ Storage::url($viewProduct->image_path) }}"
                                        alt="{{ $viewProduct->name }}"
                                        class="w-full sm:w-48 h-48 rounded-xl object-cover border-2 border-zinc-200 shadow-md">
                                @else
                                    <div
                                        class="w-full sm:w-48 h-48 bg-gradient-to-br from-zinc-200 to-zinc-300 rounded-xl flex items-center justify-center">
                                        <svg class="w-20 h-20 text-zinc-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h4 class="text-xl font-bold text-zinc-900">{{ $viewProduct->name }}</h4>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium mt-2 {{ $viewProduct->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $viewProduct->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <span
                                        class="px-3 py-1 bg-primary-100 text-primary-800 rounded-lg text-sm font-medium">{{ $viewProduct->category->name }}</span>
                                </div>
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-zinc-600">Harga</span>
                                        <span class="text-lg font-bold text-zinc-900">Rp
                                            {{ number_format($viewProduct->price, 0, ',', '.') }}<span
                                                class="text-sm font-normal text-zinc-500">/{{ $viewProduct->unit }}</span></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-zinc-600">Stok Tersedia</span>
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium {{ $viewProduct->stock > 10 ? 'bg-green-100 text-green-800' : ($viewProduct->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">{{ number_format($viewProduct->stock) }}
                                            {{ $viewProduct->unit }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h5 class="text-sm font-bold text-zinc-700 mb-2">Deskripsi</h5>
                            <p class="text-sm text-zinc-600 leading-relaxed">{{ $viewProduct->description }}</p>
                        </div>

                        <!-- Store Information -->
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200">
                            <h5 class="text-sm font-bold text-zinc-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Informasi Toko
                            </h5>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-xs text-zinc-600 mb-1">Nama Toko</p>
                                    <p class="text-sm font-semibold text-zinc-900">
                                        {{ $viewProduct->petaniProfile->farm_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-600 mb-1">Pemilik</p>
                                    <p class="text-sm font-semibold text-zinc-900">
                                        {{ $viewProduct->petaniProfile->user->name }}</p>
                                </div>
                                @if ($viewProduct->petaniProfile->address)
                            </div>
                        </div>
                        <p class="text-sm text-zinc-700">{{ $viewProduct->petaniProfile->address }}</p>
                    </div>
    @endif
</div>
</div>
</div>

<!-- Modal Footer -->
<div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-zinc-200 bg-zinc-50">
    <button type="button" wire:click="closeModal"
        class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Tutup</button>
    <button type="button" wire:click="openEditModal({{ $viewProduct->id }})"
        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        <span>Edit Produk</span>
    </button>
</div>
</div>
</div>
</div>
@endif
</div>

@push('scripts')
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Produk?',
                html: `Apakah Anda yakin ingin menghapus produk <strong>${name}</strong>?<br><small class="text-zinc-600">Tindakan ini tidak dapat dibatalkan.</small>`,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.find('{{ $this->getId() }}').call('delete', id);
                }
            });
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('product-saved', (event) => {
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

            Livewire.on('product-deleted', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
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
