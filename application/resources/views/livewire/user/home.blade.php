<div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 md:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-6 animate-fadeIn">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-zinc-900 leading-tight">
                        Produk Pertanian
                        <span
                            class="block bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            Segar & Berkualitas
                        </span>
                    </h1>
                    <p class="text-lg text-zinc-600 leading-relaxed">
                        Dapatkan hasil pertanian terbaik langsung dari petani lokal. Segar, alami, dan mendukung ekonomi
                        petani Indonesia.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-white bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            Belanja Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-primary-600 bg-white hover:bg-zinc-50 border-2 border-primary-200 rounded-lg transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">1000+</div>
                            <div class="text-sm text-zinc-600 mt-1">Produk</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">500+</div>
                            <div class="text-sm text-zinc-600 mt-1">Petani</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">5000+</div>
                            <div class="text-sm text-zinc-600 mt-1">Pelanggan</div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative animate-fadeIn animation-delay-200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&h=600&fit=crop"
                            alt="Fresh Vegetables" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/20 to-transparent"></div>
                    </div>

                    <!-- Floating Card -->
                    <div
                        class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-xl p-4 border border-zinc-100 animate-bounce-slow">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-accent-400 to-secondary-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-zinc-900">100% Organik</div>
                                <div class="text-xs text-zinc-500">Tanpa Pestisida</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute bottom-0 right-0 w-72 h-72 bg-secondary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
        </div>
    </section>

    <!-- Categories Section -->
    @if ($categories->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-zinc-900 mb-4">Kategori Produk</h2>
                    <p class="text-lg text-zinc-600">Pilih kategori sesuai kebutuhan Anda</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($categories as $category)
                        <a href="{{ route('products', ['category' => $category->id]) }}"
                            class="group relative bg-gradient-to-br from-zinc-50 to-zinc-100 hover:from-primary-50 hover:to-secondary-50 rounded-xl p-6 text-center transition-all duration-300 hover:shadow-lg border border-zinc-200 hover:border-primary-200">
                            <div
                                class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-primary-100 to-secondary-100 group-hover:from-primary-200 group-hover:to-secondary-200 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110">
                                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-zinc-900 mb-1">{{ $category->name }}</h3>
                            <p class="text-xs text-zinc-500">{{ $category->products_count }} Produk</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Featured Products Section -->
    @if ($featuredProducts->count() > 0)
        <section class="py-16 bg-zinc-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-zinc-900 mb-2">Produk Pilihan</h2>
                        <p class="text-lg text-zinc-600">Produk terbaik dan terpopuler minggu ini</p>
                    </div>
                    <a href="{{ route('products') }}"
                        class="hidden sm:inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold transition-colors">
                        Lihat Semua
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($featuredProducts as $product)
                        <div
                            class="group bg-white rounded-xl overflow-hidden border border-zinc-200 hover:border-primary-200 transition-all duration-300 hover:shadow-xl">
                            <!-- Product Image -->
                            <div class="relative aspect-square overflow-hidden bg-zinc-100">
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200">
                                        <svg class="w-20 h-20 text-zinc-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-white bg-primary-600/90 backdrop-blur-sm rounded-full">
                                        {{ $product->category->name ?? 'Lainnya' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3
                                    class="font-semibold text-zinc-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                    {{ $product->name }}
                                </h3>

                                <!-- Farmer Info -->
                                <div class="flex items-center text-xs text-zinc-500 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $product->petaniProfile->user->name ?? 'Petani' }}
                                </div>

                                <!-- Price & Action -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-lg font-bold text-primary-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                        <div class="text-xs text-zinc-500">per {{ $product->unit }}</div>
                                    </div>
                                    <button
                                        class="p-2 bg-primary-50 text-primary-600 hover:bg-primary-100 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Mobile View All Button -->
                <div class="mt-8 text-center sm:hidden">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center justify-center w-full px-6 py-3 text-base font-semibold text-primary-600 bg-white border-2 border-primary-200 rounded-lg hover:bg-primary-50 transition-colors">
                        Lihat Semua Produk
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-zinc-900 mb-4">Mengapa Memilih KawanHijau?</h2>
                <p class="text-lg text-zinc-600">Keuntungan berbelanja di platform kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-900 mb-2">Produk Berkualitas</h3>
                    <p class="text-zinc-600">Semua produk dipilih langsung dari petani terpercaya dengan kualitas
                        terjamin</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-accent-100 to-secondary-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-accent-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-zinc-600">Produk segar dikirim langsung dari kebun ke rumah Anda dengan cepat</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-cream-100 to-secondary-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-900 mb-2">Harga Terjangkau</h3>
                    <p class="text-zinc-600">Dapatkan harga terbaik langsung dari petani tanpa perantara berlebihan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-primary-500 to-secondary-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Siap Berbelanja Produk Segar?
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    Daftar sekarang dan dapatkan penawaran spesial untuk member baru
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-primary-600 bg-white hover:bg-zinc-50 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            Daftar Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-semibold text-primary-600 bg-white hover:bg-zinc-50 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            Mulai Berbelanja
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
</div>
