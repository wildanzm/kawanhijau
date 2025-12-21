<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Laporan Penjualan</h1>
                <p class="text-sm text-zinc-600 mt-1">Pantau dan analisis penjualan produk Anda</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Sales -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Total Penjualan</p>
                    <p class="text-2xl font-bold text-zinc-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Semua waktu</p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Monthly Sales -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Penjualan Bulan Ini</p>
                    <p class="text-2xl font-bold text-zinc-900">Rp {{ number_format($monthlySales, 0, ',', '.') }}</p>
                    <p class="text-xs text-zinc-500 mt-2">{{ now()->translatedFormat('F Y') }}</p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Total Transaksi</p>
                    <p class="text-2xl font-bold text-zinc-900">{{ number_format($totalTransactions) }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Pesanan selesai</p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Products Sold -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Produk Terjual</p>
                    <p class="text-2xl font-bold text-zinc-900">{{ number_format($totalProductsSold) }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Total unit</p>
                </div>
                <div
                    class="w-14 h-14 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
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
                    <p class="text-xs text-amber-800 mt-1">Silakan lengkapi profil petani Anda untuk melihat data
                        penjualan.</p>
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
                        placeholder="Cari nomor invoice atau nama pembeli...">
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
                <select wire:model.live="productFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <select wire:model.live="dateFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Waktu</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
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
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            No. Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Pembeli</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Total</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($sales as $sale)
                        <tr wire:key="sale-{{ $sale->id }}" class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm text-zinc-900">
                                        {{ $sale->order->created_at->translatedFormat('d M Y') }}</p>
                                    <p class="text-xs text-zinc-500">
                                        {{ $sale->order->created_at->translatedFormat('H:i') }} WIB</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="text-sm font-bold text-primary-600">#{{ $sale->order->invoice_number }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($sale->product->image_path)
                                        <img src="{{ Storage::url($sale->product->image_path) }}"
                                            alt="{{ $sale->product->name }}"
                                            class="w-10 h-10 rounded-lg object-cover mr-3">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-zinc-200 flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900">{{ $sale->product->name }}</p>
                                        <p class="text-xs text-zinc-500">{{ $sale->product->category->name ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-zinc-900">{{ $sale->order->user->name }}</p>
                                    <p class="text-xs text-zinc-500">{{ $sale->order->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $sale->quantity }} {{ $sale->product->unit }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-zinc-900">Rp
                                    {{ number_format($sale->subtotal, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">@ Rp
                                    {{ number_format($sale->unit_price, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button wire:click="openViewModal({{ $sale->id }})"
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                    title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <p class="text-zinc-500 font-medium mb-2">Belum ada data penjualan</p>
                                <p class="text-xs text-zinc-400">Penjualan akan muncul setelah pesanan selesai dibayar
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden divide-y divide-zinc-200">
            @forelse($sales as $sale)
                <div wire:key="sale-mobile-{{ $sale->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                    <div class="flex items-start space-x-3 mb-3">
                        @if ($sale->product->image_path)
                            <img src="{{ Storage::url($sale->product->image_path) }}"
                                alt="{{ $sale->product->name }}" class="w-14 h-14 rounded-lg object-cover">
                        @else
                            <div class="w-14 h-14 rounded-lg bg-zinc-200 flex items-center justify-center">
                                <svg class="w-7 h-7 text-zinc-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-sm font-semibold text-zinc-900">{{ $sale->product->name }}</p>
                                <span
                                    class="text-xs text-zinc-500">{{ $sale->order->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <p class="text-xs text-zinc-500 mb-1">#{{ $sale->order->invoice_number }}</p>
                            <p class="text-xs text-zinc-600 mb-2">{{ $sale->order->user->name }}</p>
                            <div class="flex items-center justify-between">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $sale->quantity }} {{ $sale->product->unit }}
                                </span>
                                <p class="text-sm font-bold text-zinc-900">Rp
                                    {{ number_format($sale->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <button wire:click="openViewModal({{ $sale->id }})"
                        class="w-full px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100 transition-colors">
                        Lihat Detail
                    </button>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <p class="text-zinc-500 font-medium mb-2">Belum ada data penjualan</p>
                    <p class="text-xs text-zinc-400">Penjualan akan muncul setelah pesanan selesai dibayar</p>
                </div>
            @endforelse
        </div>

        @if ($sales->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

    <!-- Modal View Sale Details -->
    @if ($showModal && $selectedSale)
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
                        class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 bg-gradient-to-r from-green-50 to-emerald-50">
                        <h3 class="text-lg font-bold text-zinc-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Detail Penjualan
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
                            <!-- Product Info -->
                            <div class="flex items-start space-x-4 pb-4 border-b border-zinc-200">
                                @if ($selectedSale->product->image_path)
                                    <img src="{{ Storage::url($selectedSale->product->image_path) }}"
                                        alt="{{ $selectedSale->product->name }}"
                                        class="w-24 h-24 rounded-xl object-cover">
                                @else
                                    <div class="w-24 h-24 rounded-xl bg-zinc-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-zinc-900 mb-1">
                                        {{ $selectedSale->product->name }}</h4>
                                    <p class="text-sm text-zinc-600 mb-2">{{ $selectedSale->product->description }}
                                    </p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $selectedSale->product->category->name ?? 'Tidak ada kategori' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Transaction Details -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-zinc-50 rounded-lg p-3">
                                    <p class="text-xs text-zinc-500 mb-1">No. Invoice</p>
                                    <p class="text-sm font-bold text-primary-600">
                                        #{{ $selectedSale->order->invoice_number }}</p>
                                </div>
                                <div class="bg-zinc-50 rounded-lg p-3">
                                    <p class="text-xs text-zinc-500 mb-1">Tanggal Transaksi</p>
                                    <p class="text-sm font-semibold text-zinc-900">
                                        {{ $selectedSale->order->created_at->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>

                            <!-- Buyer Info -->
                            <div>
                                <h5 class="text-sm font-semibold text-zinc-700 mb-3">Informasi Pembeli</h5>
                                <div class="bg-zinc-50 rounded-lg p-4 space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-zinc-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span
                                            class="text-sm text-zinc-900">{{ $selectedSale->order->user->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-zinc-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span
                                            class="text-sm text-zinc-900">{{ $selectedSale->order->user->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Sale Details -->
                            <div>
                                <h5 class="text-sm font-semibold text-zinc-700 mb-3">Detail Penjualan</h5>
                                <div class="bg-zinc-50 rounded-lg p-4 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-zinc-600">Jumlah</span>
                                        <span
                                            class="text-sm font-semibold text-zinc-900">{{ $selectedSale->quantity }}
                                            {{ $selectedSale->product->unit }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-zinc-600">Harga Satuan</span>
                                        <span class="text-sm font-semibold text-zinc-900">Rp
                                            {{ number_format($selectedSale->unit_price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="pt-3 border-t border-zinc-200">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-bold text-zinc-700">Total Penjualan</span>
                                            <span class="text-lg font-bold text-green-600">Rp
                                                {{ number_format($selectedSale->subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Status -->
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-green-900">Pembayaran Terverifikasi</p>
                                        <p class="text-xs text-green-700">Pesanan telah dibayar dan diproses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
