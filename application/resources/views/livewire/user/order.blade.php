<div class="min-h-screen bg-zinc-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-zinc-900">Pesanan Saya</h1>
            <p class="text-sm text-zinc-600 mt-1">Kelola dan pantau status pesanan Anda</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Orders -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-600 mb-1">Total Pesanan</p>
                        <p class="text-2xl font-bold text-zinc-900">{{ number_format($totalOrders) }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-600 mb-1">Menunggu Pembayaran</p>
                        <p class="text-2xl font-bold text-zinc-900">{{ number_format($pendingOrders) }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Shipping Orders -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-600 mb-1">Sedang Dikirim</p>
                        <p class="text-2xl font-bold text-zinc-900">{{ number_format($shippingOrders) }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-zinc-600 mb-1">Pesanan Selesai</p>
                        <p class="text-2xl font-bold text-zinc-900">{{ number_format($completedOrders) }}</p>
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
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
                            placeholder="Cari nomor invoice...">
                        <div wire:loading wire:target="search"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
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
                <div class="flex items-center gap-2">
                    <select wire:model.live="statusFilter"
                        class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Pembayaran</option>
                        <option value="paid">Sudah Dibayar</option>
                        <option value="shipping">Sedang Dikirim</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
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
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                No. Invoice</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Produk</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200">
                        @forelse($orders as $order)
                            <tr wire:key="order-{{ $order->id }}" class="hover:bg-zinc-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm font-bold text-primary-600">#{{ $order->invoice_number }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <p class="text-sm text-zinc-900">
                                            {{ $order->created_at->translatedFormat('d M Y') }}</p>
                                        <p class="text-xs text-zinc-500">
                                            {{ $order->created_at->translatedFormat('H:i') }} WIB</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($order->orderItems->first() && $order->orderItems->first()->product)
                                            @if ($order->orderItems->first()->product->image_path)
                                                <img src="{{ Storage::url($order->orderItems->first()->product->image_path) }}"
                                                    alt="Product" class="w-10 h-10 rounded-lg object-cover mr-3">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-zinc-200 flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-zinc-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium text-zinc-900">
                                                {{ $order->orderItems->count() }} Produk
                                            </p>
                                            <p class="text-xs text-zinc-500">
                                                {{ $order->orderItems->sum('quantity') }} Item
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-bold text-zinc-900">Rp
                                        {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($order->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif($order->status === 'paid')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                                <path fill-rule="evenodd"
                                                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Sudah Dibayar
                                        </span>
                                    @elseif($order->status === 'shipping')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 20 20">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                            Sedang Dikirim
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button wire:click="openViewModal({{ $order->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        @if ($order->status === 'shipping')
                                            <button onclick="confirmReceivedOrder({{ $order->id }})"
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                title="Konfirmasi Diterima">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="text-zinc-500 font-medium mb-2">Belum ada pesanan</p>
                                    <p class="text-xs text-zinc-400">Pesanan Anda akan muncul di sini</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden divide-y divide-zinc-200">
                @forelse($orders as $order)
                    <div wire:key="order-mobile-{{ $order->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-sm font-bold text-primary-600">#{{ $order->invoice_number }}</p>
                                <p class="text-xs text-zinc-500 mt-1">
                                    {{ $order->created_at->translatedFormat('d M Y, H:i') }} WIB</p>
                            </div>
                            @if ($order->status === 'pending')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    Menunggu
                                </span>
                            @elseif($order->status === 'paid')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Dibayar
                                </span>
                            @elseif($order->status === 'shipping')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    Dikirim
                                </span>
                            @elseif($order->status === 'completed')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Batal
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-3 mb-3">
                            @if ($order->orderItems->first() && $order->orderItems->first()->product)
                                @if ($order->orderItems->first()->product->image_path)
                                    <img src="{{ Storage::url($order->orderItems->first()->product->image_path) }}"
                                        alt="Product" class="w-14 h-14 rounded-lg object-cover">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-zinc-200 flex items-center justify-center">
                                        <svg class="w-7 h-7 text-zinc-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-zinc-900">{{ $order->orderItems->count() }} Produk
                                </p>
                                <p class="text-xs text-zinc-500">{{ $order->orderItems->sum('quantity') }} Item</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-zinc-900">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <div class="flex items-center space-x-2">
                                <button wire:click="openViewModal({{ $order->id }})"
                                    class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100 transition-colors">
                                    Lihat Detail
                                </button>
                                @if ($order->status === 'shipping')
                                    <button onclick="confirmReceivedOrder({{ $order->id }})"
                                        class="px-3 py-1.5 bg-green-50 text-green-600 rounded-lg text-xs font-medium hover:bg-green-100 transition-colors flex items-center space-x-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Terima</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="text-zinc-500 font-medium mb-2">Belum ada pesanan</p>
                        <p class="text-xs text-zinc-400">Pesanan Anda akan muncul di sini</p>
                    </div>
                @endforelse
            </div>

            @if ($orders->hasPages())
                <div class="px-6 py-4 border-t border-zinc-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal View Order Details -->
    @if ($showModal && $selectedOrder)
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

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full"
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
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Detail Pesanan
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
                    <div class="px-6 py-5 max-h-[70vh] overflow-y-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column: Order Info -->
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-700 mb-3">Informasi Pesanan</h4>
                                    <div class="bg-zinc-50 rounded-lg p-4 space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-xs text-zinc-600">No. Invoice</span>
                                            <span
                                                class="text-sm font-bold text-primary-600">#{{ $selectedOrder->invoice_number }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-xs text-zinc-600">Tanggal Pesanan</span>
                                            <span
                                                class="text-sm font-semibold text-zinc-900">{{ $selectedOrder->created_at->translatedFormat('d F Y') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-xs text-zinc-600">Status</span>
                                            @if ($selectedOrder->status === 'pending')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    Menunggu Pembayaran
                                                </span>
                                            @elseif($selectedOrder->status === 'paid')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Sudah Dibayar
                                                </span>
                                            @elseif($selectedOrder->status === 'shipping')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    Sedang Dikirim
                                                </span>
                                            @elseif($selectedOrder->status === 'completed')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-700 mb-3">Alamat Pengiriman</h4>
                                    <div class="bg-zinc-50 rounded-lg p-4">
                                        <p class="text-sm text-zinc-900">
                                            {{ $selectedOrder->shipping_address ?? 'Alamat tidak tersedia' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Product List -->
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-700 mb-3">Produk Pesanan</h4>
                                <div class="space-y-3">
                                    @foreach ($selectedOrder->orderItems as $item)
                                        <div class="flex items-start space-x-3 bg-zinc-50 rounded-lg p-3">
                                            @if ($item->product && $item->product->image_path)
                                                <img src="{{ Storage::url($item->product->image_path) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-16 h-16 rounded-lg object-cover">
                                            @else
                                                <div
                                                    class="w-16 h-16 rounded-lg bg-zinc-200 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-zinc-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-zinc-900">
                                                    {{ $item->product->name ?? 'Produk tidak tersedia' }}</p>
                                                <p class="text-xs text-zinc-500 mt-1">{{ $item->quantity }} x Rp
                                                    {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                                <p class="text-sm font-bold text-zinc-900 mt-1">Rp
                                                    {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Total -->
                                <div class="mt-4 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-bold text-zinc-700">Total Pembayaran</span>
                                        <span class="text-lg font-bold text-primary-600">Rp
                                            {{ number_format($selectedOrder->total_amount, 0, ',', '.') }}</span>
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

    @script
        <script>
            window.confirmReceivedOrder = function(orderId) {
                Swal.fire({
                    title: 'Konfirmasi Pesanan Diterima?',
                    text: 'Pesanan akan ditandai sebagai selesai dan tidak dapat diubah lagi',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Sudah Diterima',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.confirmReceived(orderId);
                    }
                });
            }

            $wire.on('order-completed', (data) => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data[0].message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endscript
</div>
