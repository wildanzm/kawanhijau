<div class="min-h-screen bg-zinc-50 pb-8">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-zinc-600 hover:text-primary-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('cart') }}"
                    class="text-zinc-600 hover:text-primary-600 transition-colors">Keranjang</a>
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary-600 font-medium">Checkout</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Shipping Address & Cart Items -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Address Form -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Alamat Pengiriman
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Nama Penerima</label>
                                <input type="text" wire:model="recipient_name"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="Nama lengkap penerima">
                                @error('recipient_name')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Nomor Telepon</label>
                                <input type="text" wire:model="phone_number"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="08xxxxxxxxxx">
                                @error('phone_number')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Alamat Lengkap</label>
                            <textarea wire:model="street_address" rows="3"
                                class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="Jalan, RT/RW, Nomor Rumah, Kelurahan, Kecamatan"></textarea>
                            @error('street_address')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Kota</label>
                                <input type="text" wire:model="city"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="Nama kota">
                                @error('city')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Provinsi</label>
                                <input type="text" wire:model="province"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="Nama provinsi">
                                @error('province')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 mb-2">Kode Pos</label>
                                <input type="text" wire:model="postal_code"
                                    class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="12345">
                                @error('postal_code')
                                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Catatan (Opsional)</label>
                            <textarea wire:model="notes" rows="2"
                                class="w-full px-4 py-2.5 border border-zinc-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                placeholder="Catatan untuk penjual atau kurir"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof Upload -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Bukti Pembayaran
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800">
                                <span class="font-semibold">Informasi Pembayaran:</span>
                            </p>
                            <ul class="mt-2 text-sm text-blue-700 space-y-1">
                                <li>• Bank: BCA</li>
                                <li>• No. Rekening: 1234567890</li>
                                <li>• Atas Nama: KawanHijau Indonesia</li>
                                <li>• Total: <span class="font-bold">Rp
                                        {{ number_format($this->total, 0, ',', '.') }}</span></li>
                            </ul>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Upload Bukti Transfer <span
                                    class="text-red-500">*</span></label>
                            <div
                                class="border-2 border-dashed border-zinc-300 rounded-lg p-6 text-center hover:border-primary-500 transition-colors">
                                <input type="file" wire:model="payment_proof" accept="image/*" class="hidden"
                                    id="payment_proof">
                                <label for="payment_proof" class="cursor-pointer">
                                    @if ($payment_proof)
                                        <div class="space-y-3">
                                            <div class="mx-auto w-32 h-32 bg-zinc-100 rounded-lg overflow-hidden">
                                                <img src="{{ $payment_proof->temporaryUrl() }}" alt="Preview"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <p class="text-sm font-medium text-green-600">Bukti pembayaran telah
                                                dipilih</p>
                                            <p class="text-xs text-zinc-500">Klik untuk mengubah</p>
                                        </div>
                                    @else
                                        <svg class="mx-auto w-12 h-12 text-zinc-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="mt-2 text-sm font-medium text-zinc-900">Klik untuk upload bukti
                                            pembayaran</p>
                                        <p class="mt-1 text-xs text-zinc-500">PNG, JPG hingga 2MB</p>
                                    @endif
                                </label>
                            </div>
                            @error('payment_proof')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                            <div wire:loading wire:target="payment_proof" class="mt-2 text-sm text-primary-600">
                                Mengunggah...
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Items Table -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Produk yang Dibeli
                        </h2>
                    </div>

                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 border-b border-zinc-200">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                        Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                        Penjual</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                        Jumlah</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                        Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200">
                                @foreach ($cartItems as $item)
                                    <tr class="hover:bg-zinc-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-16 h-16 bg-zinc-100 rounded-lg overflow-hidden flex-shrink-0">
                                                    @if ($item->product->image_path)
                                                        <img src="{{ Storage::url($item->product->image_path) }}"
                                                            alt="{{ $item->product->name }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-zinc-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-zinc-900 line-clamp-2">
                                                        {{ $item->product->name }}</p>
                                                    @if ($item->product->category)
                                                        <p class="text-xs text-zinc-500 mt-1">
                                                            {{ $item->product->category->name }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-sm text-zinc-900">
                                                {{ $item->product->petaniProfile->user->name ?? '-' }}</p>
                                            @if ($item->product->petaniProfile->city)
                                                <p class="text-xs text-zinc-500 mt-1">
                                                    {{ $item->product->petaniProfile->city }}</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <p class="text-sm font-medium text-zinc-900">Rp
                                                {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                            @if ($item->product->unit)
                                                <p class="text-xs text-zinc-500">/ {{ $item->product->unit }}</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <p class="text-sm font-semibold text-zinc-900">{{ $item->quantity }}
                                                {{ $item->product->unit ?? 'pcs' }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <p class="text-sm font-bold text-primary-600">Rp
                                                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="md:hidden divide-y divide-zinc-200">
                        @foreach ($cartItems as $item)
                            <div class="p-4 space-y-3">
                                <div class="flex space-x-3">
                                    <div class="w-20 h-20 bg-zinc-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if ($item->product->image_path)
                                            <img src="{{ Storage::url($item->product->image_path) }}"
                                                alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-zinc-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-zinc-900 line-clamp-2">
                                            {{ $item->product->name }}</p>
                                        <p class="text-xs text-zinc-500 mt-1">
                                            {{ $item->product->petaniProfile->user->name ?? '-' }}</p>
                                        <div class="flex items-center justify-between mt-2">
                                            <p class="text-sm font-medium text-zinc-900">Rp
                                                {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                            <p class="text-xs text-zinc-600">x {{ $item->quantity }}</p>
                                        </div>
                                        <p class="text-sm font-bold text-primary-600 mt-1">Rp
                                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary (Sticky) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-zinc-200 overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Ringkasan Pesanan
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-zinc-600">Subtotal Produk ({{ $cartItems->count() }} item)</span>
                                <span class="font-semibold text-zinc-900">Rp
                                    {{ number_format($this->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-zinc-200 pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-bold text-zinc-900">Total Pembayaran</span>
                                <span class="text-xl font-bold text-primary-600">Rp
                                    {{ number_format($this->total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button wire:click="processCheckout" type="button" wire:loading.attr="disabled"
                            class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg wire:loading wire:target="processCheckout" class="animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <svg wire:loading.remove wire:target="processCheckout" class="w-5 h-5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Buat Pesanan</span>
                        </button>

                        <div class="pt-4 border-t border-zinc-200 space-y-2">
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Data Anda aman
                            </div>
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Transaksi terjamin
                            </div>
                            <div class="flex items-center text-xs text-zinc-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Produk berkualitas
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('checkout-error', (data) => {
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
