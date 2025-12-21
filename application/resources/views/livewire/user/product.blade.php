<div class="min-h-screen bg-zinc-50 pb-8">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-zinc-600 hover:text-primary-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary-600 font-medium">Produk</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Sidebar - Filters -->
            <aside class="lg:w-64 flex-shrink-0">
                <!-- Mobile Filter Toggle -->
                <button @click="$wire.showFilters = !$wire.showFilters"
                    class="lg:hidden w-full flex items-center justify-between px-4 py-3 bg-white rounded-lg shadow-sm border border-zinc-200 mb-4">
                    <span class="font-semibold text-zinc-900">Filter Produk</span>
                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': $wire.showFilters }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Filter Card -->
                <div :class="{ 'hidden lg:block': !$wire.showFilters }"
                    class="bg-white rounded-lg shadow-sm border border-zinc-200 p-5 space-y-6">
                    <!-- Filter Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-zinc-200">
                        <h3 class="font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </h3>
                        <button wire:click="resetFilters"
                            class="text-xs font-medium text-primary-600 hover:text-primary-700 transition-colors">
                            Reset
                        </button>
                    </div>

                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Cari Produk</label>
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama produk..."
                                class="w-full pl-10 pr-4 py-2 text-sm border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-zinc-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-3">Kategori</label>
                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            <label
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-zinc-50 cursor-pointer transition-colors">
                                <div class="flex items-center">
                                    <input type="radio" wire:model.live="selectedCategory" value=""
                                        class="w-4 h-4 text-primary-600 border-zinc-300 focus:ring-primary-500">
                                    <span class="ml-3 text-sm text-zinc-700">Semua Kategori</span>
                                </div>
                                <span class="text-xs text-zinc-500 font-medium">{{ $products->total() }}</span>
                            </label>
                            @foreach ($categories as $category)
                                <label
                                    class="flex items-center justify-between p-2 rounded-lg hover:bg-zinc-50 cursor-pointer transition-colors">
                                    <div class="flex items-center">
                                        <input type="radio" wire:model.live="selectedCategory"
                                            value="{{ $category->id }}"
                                            class="w-4 h-4 text-primary-600 border-zinc-300 focus:ring-primary-500">
                                        <span class="ml-3 text-sm text-zinc-700">{{ $category->name }}</span>
                                    </div>
                                    <span
                                        class="text-xs text-zinc-500 font-medium">{{ $category->products_count }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-3">Rentang Harga</label>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs text-zinc-600 mb-1">Harga Minimum</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-sm text-zinc-500">Rp</span>
                                    <input type="number" wire:model.live.debounce.500ms="minPrice" placeholder="0"
                                        class="w-full pl-9 pr-4 py-2 text-sm border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-zinc-600 mb-1">Harga Maksimum</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-sm text-zinc-500">Rp</span>
                                    <input type="number" wire:model.live.debounce.500ms="maxPrice"
                                        placeholder="1000000"
                                        class="w-full pl-9 pr-4 py-2 text-sm border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Content - Products -->
            <main class="flex-1">
                <!-- Header with Sort and Result Count -->
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-4 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center">
                            <h2 class="text-lg font-bold text-zinc-900">
                                {{ $products->total() }} Produk Ditemukan
                            </h2>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-zinc-600 font-medium">Urutkan:</label>
                            <select wire:model.live="sortBy"
                                class="px-4 py-2 text-sm border border-zinc-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                <option value="latest">Terbaru</option>
                                <option value="price_asc">Harga Terendah</option>
                                <option value="price_desc">Harga Tertinggi</option>
                                <option value="name_asc">Nama A-Z</option>
                                <option value="name_desc">Nama Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                @if ($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach ($products as $product)
                            <a href="{{ route('product.detail', $product->id) }}"
                                class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden hover:shadow-lg hover:border-primary-300 transition-all duration-300 group">
                                <!-- Product Image -->
                                <div class="aspect-square bg-zinc-100 overflow-hidden relative">
                                    @if ($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200">
                                            <svg class="w-16 h-16 text-zinc-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <!-- Stock Badge -->
                                    <div class="absolute top-2 right-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold bg-white/90 backdrop-blur-sm text-zinc-700 rounded-full shadow-sm">
                                            Stok: {{ $product->stock }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-3 space-y-2">
                                    <h3
                                        class="text-sm font-medium text-zinc-900 line-clamp-2 group-hover:text-primary-600 transition-colors min-h-[40px]">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="flex items-baseline justify-between">
                                        <div>
                                            <p class="text-lg font-bold text-primary-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                            @if ($product->unit)
                                                <p class="text-xs text-zinc-500">per {{ $product->unit }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Category Badge -->
                                    @if ($product->category)
                                        <div class="flex items-center space-x-1 text-xs text-zinc-500">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            <span>{{ $product->category->name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Add to Cart Button -->
                                <div class="px-3 pb-3">
                                    <button wire:click.prevent="addToCart({{ $product->id }})"
                                        class="w-full py-2 px-4 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span>Tambah</span>
                                    </button>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-24 h-24 bg-zinc-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 mb-2">Produk Tidak Ditemukan</h3>
                                <p class="text-zinc-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                                <button wire:click="resetFilters"
                                    class="px-6 py-2 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                    Reset Filter
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>

    @script
        <script>
            $wire.on('cart-updated', (data) => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data[0].product_name + ' berhasil ditambahkan ke keranjang!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });

            $wire.on('cart-error', (data) => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data[0].message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endscript
</div>
