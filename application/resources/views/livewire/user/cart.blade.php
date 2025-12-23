<div class="min-h-screen bg-zinc-50 pb-8">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-zinc-600 hover:text-primary-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary-600 font-medium">Keranjang</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @auth
            @if ($cart && $cart->items->count() > 0)
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Left - Cart Items -->
                    <div class="flex-1 space-y-4">
                        <!-- Cart Items -->
                        @foreach ($cart->items as $item)
                            <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-4 hover:shadow-md transition-shadow"
                                wire:key="cart-item-{{ $item->id }}-{{ $item->quantity }}">
                                <div class="flex items-start space-x-4">
                                    <!-- Checkbox -->
                                    <div class="flex-shrink-0 pt-1">
                                        <input type="checkbox" wire:model.live="selectedItems" value="{{ $item->id }}"
                                            class="w-5 h-5 text-primary-600 border-zinc-300 rounded focus:ring-primary-500">
                                    </div>

                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <a href="#"
                                            class="block w-20 h-20 sm:w-24 sm:h-24 bg-zinc-100 rounded-lg overflow-hidden">
                                            @if ($item->product->image_path)
                                                <img src="{{ Storage::url($item->product->image_path) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200">
                                                    <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </a>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                            <div class="flex-1">
                                                <a href="#"
                                                    class="text-sm sm:text-base font-medium text-zinc-900 hover:text-primary-600 transition-colors line-clamp-2">
                                                    {{ $item->product->name }}
                                                </a>
                                                @if ($item->product->category)
                                                    <p class="text-xs text-zinc-500 mt-1 flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                        {{ $item->product->category->name }}
                                                    </p>
                                                @endif
                                                <div class="mt-2">
                                                    <p class="text-base sm:text-lg font-bold text-primary-600">
                                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                                    </p>
                                                    @if ($item->product->unit)
                                                        <p class="text-xs text-zinc-500">per {{ $item->product->unit }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Delete Button - Desktop -->
                                            <button onclick="confirmDeleteItem({{ $item->id }})"
                                                class="hidden sm:block text-zinc-400 hover:text-red-600 transition-colors p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Quantity Controls & Actions -->
                                        <div class="flex items-center justify-between mt-4">
                                            <!-- Quantity Control -->
                                            <div class="flex items-center space-x-2">
                                                <button
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                                    @if ($item->quantity <= 1) disabled @endif
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg border border-zinc-300 text-zinc-700 hover:bg-zinc-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <div
                                                    class="w-16 text-center py-1.5 border border-zinc-300 rounded-lg font-semibold text-zinc-900">
                                                    {{ $item->quantity }}
                                                </div>
                                                <button
                                                    wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                    @if ($item->quantity >= $item->product->stock) disabled @endif
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg border border-zinc-300 text-zinc-700 hover:bg-zinc-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                                <span class="text-xs text-zinc-500 ml-2">Stok:
                                                    {{ $item->product->stock }}</span>
                                            </div>

                                            <!-- Delete Button - Mobile -->
                                            <button onclick="confirmDeleteItem({{ $item->id }})"
                                                class="sm:hidden text-red-600 hover:text-red-700 transition-colors text-sm font-medium flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="mt-3 pt-3 border-t border-zinc-200">
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-zinc-600">Subtotal:</span>
                                                <span class="text-lg font-bold text-zinc-900">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right - Summary -->
                    <div class="lg:w-96 flex-shrink-0">
                        <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-5 sticky top-24">
                            <h3 class="font-bold text-zinc-900 text-lg mb-4">Ringkasan Belanja</h3>

                            <div class="space-y-3 mb-4">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-zinc-600">Total Item</span>
                                    <span class="font-semibold text-zinc-900">{{ count($selectedItems) }} produk</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-zinc-600">Total Harga</span>
                                    <span class="text-xl font-bold text-primary-600">
                                        Rp {{ number_format($selectedTotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-zinc-200 space-y-3">
                                <button wire:click="checkout"
                                    class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Checkout ({{ count($selectedItems) }})</span>
                                </button>
                                <a href="{{ route('products') }}"
                                    class="block w-full py-3 px-4 border-2 border-primary-500 text-primary-600 hover:bg-primary-50 font-semibold rounded-lg transition-all duration-300 text-center">
                                    Lanjut Belanja
                                </a>
                            </div>

                            <!-- Info -->
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-start space-x-2">
                                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs text-blue-800 leading-relaxed">
                                        Pastikan produk yang Anda pilih sudah sesuai sebelum melakukan checkout.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-12 text-center">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div
                            class="w-32 h-32 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-zinc-900 mb-2">Keranjang Anda Kosong</h3>
                            <p class="text-zinc-600 mb-6">Yuk, mulai belanja dan isi keranjang Anda!</p>
                            <a href="{{ route('products') }}"
                                class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Mulai Belanja</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Not Logged In -->
            <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-12 text-center">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div
                        class="w-32 h-32 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-zinc-900 mb-2">Login Diperlukan</h3>
                        <p class="text-zinc-600 mb-6">Silakan login terlebih dahulu untuk melihat keranjang Anda</p>
                        <div class="flex items-center justify-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="px-8 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-8 py-3 border-2 border-primary-500 text-primary-600 hover:bg-primary-50 font-semibold rounded-lg transition-all duration-300">
                                Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    @script
        <script>
            // Confirm delete single item
            window.confirmDeleteItem = function(itemId) {
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: 'Produk akan dihapus dari keranjang',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.removeItem(itemId);
                    }
                });
            }

            // Confirm delete selected items
            window.confirmDeleteSelected = function() {
                Swal.fire({
                    title: 'Hapus Produk Terpilih?',
                    text: 'Semua produk yang dipilih akan dihapus dari keranjang',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus Semua',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.removeSelected();
                    }
                });
            }

            // Listen for cart-updated event
            $wire.on('cart-updated', () => {
                // Refresh the component
                $wire.$refresh();
            });

            // Listen for show-alert event
            $wire.on('show-alert', (event) => {
                const data = event[0];
                Swal.fire({
                    icon: data.type,
                    title: data.type === 'success' ? 'Berhasil!' : data.type === 'error' ? 'Gagal!' :
                        'Perhatian!',
                    text: data.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endscript
</div>
