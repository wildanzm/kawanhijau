<div class="min-h-screen bg-zinc-50 pb-8">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-zinc-600 hover:text-primary-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('products') }}"
                    class="text-zinc-600 hover:text-primary-600 transition-colors">Produk</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary-600 font-medium line-clamp-1">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Product Images & Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Product Images -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="p-6">
                        <!-- Main Image -->
                        <div class="aspect-square bg-zinc-100 rounded-lg overflow-hidden mb-4">
                            @if ($selectedImage)
                                <img src="{{ Storage::url($selectedImage) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200">
                                    <svg class="w-24 h-24 text-zinc-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Details Table -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Detail Produk
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody class="divide-y divide-zinc-200">
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nama Produk</td>
                                    <td class="px-6 py-4 text-sm text-zinc-900">{{ $product->name }}</td>
                                </tr>
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Kategori</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Harga</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-baseline">
                                            <span class="text-2xl font-bold text-primary-600">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                            @if ($product->unit)
                                                <span class="ml-2 text-sm text-zinc-500">/ {{ $product->unit }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Stok Tersedia</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $product->stock }} {{ $product->unit ?? 'unit' }}
                                        </span>
                                    </td>
                                </tr>
                                @if ($product->description)
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3 align-top">
                                            Deskripsi</td>
                                        <td class="px-6 py-4 text-sm text-zinc-700 leading-relaxed">
                                            {{ $product->description }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Seller Information -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informasi Penjual
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody class="divide-y divide-zinc-200">
                                @if ($product->petaniProfile)
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nama Petani</td>
                                        <td class="px-6 py-4 text-sm text-zinc-900">
                                            {{ $product->petaniProfile->user->name ?? '-' }}</td>
                                    </tr>
                                    @if ($product->petaniProfile->farm_name)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Nama Lahan
                                            </td>
                                            <td class="px-6 py-4 text-sm text-zinc-900">
                                                {{ $product->petaniProfile->farm_name }}</td>
                                        </tr>
                                    @endif
                                    @if ($product->petaniProfile->city)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Lokasi</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center text-sm text-zinc-700">
                                                    <svg class="w-4 h-4 mr-1 text-zinc-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $product->petaniProfile->city }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($product->petaniProfile->verified_at)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-6 py-4 text-sm font-semibold text-zinc-700 w-1/3">Status
                                                Verifikasi</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Terverifikasi
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td colspan="2" class="px-6 py-4 text-sm text-zinc-500 text-center">
                                            Informasi penjual tidak tersedia</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column - Purchase Card (Sticky) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-zinc-200 overflow-hidden sticky top-6">
                    <div class="p-6 space-y-4">
                        <h3 class="text-lg font-bold text-zinc-900">Atur Jumlah Pembelian</h3>

                        <!-- Quantity Selector -->
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Jumlah</label>
                            <div class="flex items-center space-x-3">
                                <button wire:click="decrementQuantity" type="button"
                                    class="w-10 h-10 flex items-center justify-center bg-zinc-100 hover:bg-zinc-200 text-zinc-700 rounded-lg transition-colors {{ $quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $quantity <= 1 ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <input type="number" wire:model="quantity" wire:change="$refresh" min="1"
                                    max="{{ $product->stock }}"
                                    class="w-20 text-center px-3 py-2 border border-zinc-300 rounded-lg font-semibold text-zinc-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <button wire:click="incrementQuantity" type="button"
                                    class="w-10 h-10 flex items-center justify-center bg-zinc-100 hover:bg-zinc-200 text-zinc-700 rounded-lg transition-colors {{ $quantity >= $product->stock ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $quantity >= $product->stock ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">Stok tersedia: {{ $product->stock }}
                                {{ $product->unit ?? 'unit' }}</p>
                        </div>

                        <!-- Subtotal -->
                        <div class="pt-4 border-t border-zinc-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-zinc-600">Subtotal</span>
                                <span class="text-xs text-zinc-500">{{ $quantity }}
                                    {{ $product->unit ?? 'unit' }}</span>
                            </div>
                            <div class="text-2xl font-bold text-primary-600">
                                Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 pt-4">
                            <button wire:click="addToCart" type="button"
                                class="w-full py-3 px-4 bg-white border-2 border-primary-600 text-primary-600 font-bold rounded-lg hover:bg-primary-50 transition-all duration-300 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Tambah ke Keranjang</span>
                            </button>

                            <button wire:click="buyNow" type="button"
                                class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>Beli Sekarang</span>
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="pt-4 border-t border-zinc-200 space-y-2">
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Produk dijamin segar
                            </div>
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Langsung dari petani
                            </div>
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Harga terjangkau
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

            $wire.on('buy-now', (data) => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Fitur checkout sedang dalam pengembangan',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endscript
</div>
