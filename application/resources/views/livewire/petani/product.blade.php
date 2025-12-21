<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Kelola Produk</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola semua produk yang Anda jual di KawanHijau</p>
            </div>
            <button wire:click="openCreateModal"
                class="px-5 py-2.5 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Produk</span>
            </button>
        </div>
    </div>

    @if (!$petaniProfile)
        <!-- Warning if no petani profile -->
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-6">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-amber-900">Profil Petani Belum Lengkap</h3>
                    <p class="text-xs text-amber-800 mt-1">Silakan lengkapi profil petani Anda untuk mulai menambahkan
                        produk.</p>
                </div>
            </div>
        </div>
    @endif

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
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Stok</th>
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
                                <div class="flex items-center">
                                    @if ($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                            class="w-12 h-12 rounded-lg object-cover mr-3">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-lg bg-zinc-200 flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900">{{ $product->name }}</p>
                                        <p class="text-xs text-zinc-500">{{ Str::limit($product->description, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $product->category->name ?? 'Tidak ada' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-zinc-900">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">per {{ $product->unit }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->stock > 10)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $product->stock }} {{ $product->unit }}
                                    </span>
                                @elseif($product->stock > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        {{ $product->stock }} {{ $product->unit }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleStatus({{ $product->id }})"
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium transition-colors {{ $product->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-zinc-100 text-zinc-800 hover:bg-zinc-200' }}">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $product->is_active ? 'bg-green-600' : 'bg-zinc-600' }} mr-1.5"></span>
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <button wire:click="openViewModal({{ $product->id }})"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button wire:click="openEditModal({{ $product->id }})"
                                        class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button
                                        onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
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
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <p class="text-zinc-500 font-medium mb-2">Belum ada produk</p>
                                <p class="text-xs text-zinc-400 mb-4">Klik tombol "Tambah Produk" untuk mulai
                                    menambahkan
                                    produk</p>
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
                    <div class="flex items-start space-x-3 mb-3">
                        @if ($product->image_path)
                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                class="w-16 h-16 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-16 rounded-lg bg-zinc-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-zinc-900 mb-1">{{ $product->name }}</p>
                            <p class="text-xs text-zinc-500 mb-2">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center space-x-2 mb-2">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $product->category->name ?? 'Tidak ada' }}
                                </span>
                                <button wire:click="toggleStatus({{ $product->id }})"
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-zinc-100 text-zinc-800' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-zinc-900">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit }}</p>
                                    <p class="text-xs text-zinc-500">Stok: {{ $product->stock }} {{ $product->unit }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button wire:click="openViewModal({{ $product->id }})"
                            class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100 transition-colors">Lihat</button>
                        <button wire:click="openEditModal({{ $product->id }})"
                            class="flex-1 px-3 py-2 bg-green-50 text-green-600 rounded-lg text-xs font-medium hover:bg-green-100 transition-colors">Edit</button>
                        <button onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
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
                    <p class="text-zinc-500 font-medium mb-2">Belum ada produk</p>
                    <p class="text-xs text-zinc-400">Klik tombol "Tambah Produk" untuk mulai menambahkan produk</p>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Create/Edit Product -->
    @if ($showModal)
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
                        class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-primary-50 to-secondary-50">
                        <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            {{ $editMode ? 'Edit Produk' : 'Tambah Produk Baru' }}
                        </h3>
                        <button type="button" wire:click="closeModal"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <form wire:submit.prevent="save" class="px-6 py-5">
                        <div class="space-y-4">
                            <!-- Product Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-zinc-700 mb-2">Nama
                                    Produk <span class="text-red-500">*</span></label>
                                <input type="text" id="name" wire:model="name"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                                    placeholder="Contoh: Tomat Segar">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Deskripsi <span
                                        class="text-red-500">*</span></label>
                                <textarea id="description" wire:model="description" rows="3"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('description') border-red-500 @enderror"
                                    placeholder="Jelaskan detail produk Anda..."></textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id"
                                    class="block text-sm font-semibold text-zinc-700 mb-2">Kategori
                                    <span class="text-red-500">*</span></label>
                                <select id="category_id" wire:model="category_id"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('category_id') border-red-500 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price & Unit -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="price" class="block text-sm font-semibold text-zinc-700 mb-2">Harga
                                        (Rp) <span class="text-red-500">*</span></label>
                                    <input type="number" id="price" wire:model="price" min="0"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('price') border-red-500 @enderror"
                                        placeholder="10000">
                                    @error('price')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="unit"
                                        class="block text-sm font-semibold text-zinc-700 mb-2">Satuan
                                        <span class="text-red-500">*</span></label>
                                    <select id="unit" wire:model="unit"
                                        class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('unit') border-red-500 @enderror">
                                        <option value="kg">Kilogram (kg)</option>
                                        <option value="gram">Gram (g)</option>
                                        <option value="liter">Liter (L)</option>
                                        <option value="pcs">Pieces (pcs)</option>
                                        <option value="pack">Pack</option>
                                        <option value="box">Box</option>
                                    </select>
                                    @error('unit')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock -->
                            <div>
                                <label for="stock" class="block text-sm font-semibold text-zinc-700 mb-2">Stok
                                    <span class="text-red-500">*</span></label>
                                <input type="number" id="stock" wire:model="stock" min="0"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all @error('stock') border-red-500 @enderror"
                                    placeholder="100">
                                @error('stock')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Foto Produk</label>
                                <div class="flex items-start space-x-4">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                            class="w-24 h-24 rounded-lg object-cover">
                                    @elseif($existingImage)
                                        <img src="{{ Storage::url($existingImage) }}" alt="Current Image"
                                            class="w-24 h-24 rounded-lg object-cover">
                                    @endif
                                    <div class="flex-1">
                                        <input type="file" id="image" wire:model="image" accept="image/*"
                                            class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition-all">
                                        <p class="mt-1 text-xs text-zinc-500">Format: JPG, PNG (Max: 2MB)</p>
                                        @error('image')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div wire:loading wire:target="image" class="mt-2">
                                    <p class="text-xs text-primary-600">Mengunggah gambar...</p>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="is_active" wire:model="is_active"
                                    class="w-4 h-4 text-primary-600 border-zinc-300 rounded focus:ring-primary-500">
                                <label for="is_active" class="text-sm font-semibold text-zinc-700">Aktifkan
                                    Produk</label>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                            <button type="button" wire:click="closeModal"
                                class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-primary-500 to-secondary-500 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $editMode ? 'Perbarui' : 'Simpan' }} Produk</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal View Product -->
    @if ($showViewModal && $selectedProduct)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showViewModal') }" x-show="show"
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
                        <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Detail Produk
                        </h3>
                        <button type="button" wire:click="closeModal"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-5">
                        <div class="space-y-4">
                            <!-- Product Image -->
                            @if ($selectedProduct->image_path)
                                <div class="w-full h-64 rounded-xl overflow-hidden">
                                    <img src="{{ Storage::url($selectedProduct->image_path) }}"
                                        alt="{{ $selectedProduct->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-full h-64 rounded-xl bg-zinc-200 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Product Info -->
                            <div class="space-y-3">
                                <div>
                                    <h4 class="text-xl font-bold text-zinc-900">{{ $selectedProduct->name }}</h4>
                                    <p class="text-sm text-zinc-600 mt-1">{{ $selectedProduct->description }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-xs text-zinc-500 mb-1">Kategori</p>
                                        <p class="text-sm font-semibold text-zinc-900">
                                            {{ $selectedProduct->category->name ?? 'Tidak ada' }}</p>
                                    </div>
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-xs text-zinc-500 mb-1">Harga</p>
                                        <p class="text-sm font-semibold text-zinc-900">Rp
                                            {{ number_format($selectedProduct->price, 0, ',', '.') }}/{{ $selectedProduct->unit }}
                                        </p>
                                    </div>
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-xs text-zinc-500 mb-1">Stok</p>
                                        <p class="text-sm font-semibold text-zinc-900">{{ $selectedProduct->stock }}
                                            {{ $selectedProduct->unit }}</p>
                                    </div>
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-xs text-zinc-500 mb-1">Status</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $selectedProduct->is_active ? 'bg-green-100 text-green-800' : 'bg-zinc-100 text-zinc-800' }}">
                                            {{ $selectedProduct->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="bg-blue-50 rounded-lg p-3">
                                    <p class="text-xs text-zinc-500 mb-1">Ditambahkan</p>
                                    <p class="text-sm font-semibold text-zinc-900">
                                        {{ $selectedProduct->created_at->translatedFormat('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Tutup</button>
                        <button type="button" wire:click="openEditModal({{ $selectedProduct->id }})"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2">
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
                confirmButtonColor: '#ef4444',
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
                    title: 'Dihapus!',
                    text: event.message,
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });

            Livewire.on('product-status-updated', (event) => {
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

            Livewire.on('product-error', (event) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: event.message,
                    confirmButtonColor: '#10b981',
                });
            });
        });
    </script>
@endpush
