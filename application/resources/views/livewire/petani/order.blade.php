<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Pesanan Masuk</h1>
                <p class="text-sm text-zinc-600 mt-1">Kelola pesanan produk Anda dari pelanggan</p>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div
                    class="px-4 py-2 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <div>
                            <p class="text-xs text-blue-600 font-medium">Total</p>
                            <p class="text-lg font-bold text-blue-700">{{ number_format($totalOrders) }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="px-4 py-2 bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-xs text-amber-600 font-medium">Pending</p>
                            <p class="text-lg font-bold text-amber-700">{{ number_format($pendingOrders) }}</p>
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
                            <p class="text-xs text-green-600 font-medium">Selesai</p>
                            <p class="text-lg font-bold text-green-700">{{ number_format($completedOrders) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 rounded-xl shadow-lg p-6 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90 mb-1">Total Pendapatan (Lunas)</p>
                <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-xs opacity-80 mt-2">Dari semua pesanan yang sudah dibayar</p>
            </div>
            <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
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
                    <p class="text-xs text-amber-800 mt-1">Silakan lengkapi profil petani Anda untuk melihat pesanan.
                    </p>
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
                        placeholder="Cari nomor pesanan atau nama pembeli...">
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
                <select wire:model.live="statusFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <select wire:model.live="dateFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Waktu</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
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
                            No. Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Pembeli</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Produk Saya</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Subtotal Saya</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($orders as $order)
                        @php
                            // Calculate farmer's items and subtotal
$farmerItems = $order->orderItems->filter(function ($item) use ($petaniProfile) {
    return $item->product && $item->product->petani_profile_id == $petaniProfile->id;
});
$farmerSubtotal = $farmerItems->sum('subtotal');
                        @endphp
                        <tr wire:key="order-{{ $order->id }}" class="hover:bg-zinc-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-primary-600">#{{ $order->invoice_number }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-zinc-900">{{ $order->user->name }}</p>
                                    <p class="text-xs text-zinc-500">{{ $order->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-1">
                                    @foreach ($farmerItems->take(2) as $item)
                                        <span class="text-xs text-zinc-700">
                                            {{ $item->quantity }}x {{ $item->product->name }}
                                        </span>
                                    @endforeach
                                    @if ($farmerItems->count() > 2)
                                        <span
                                            class="text-xs text-primary-600 font-medium">+{{ $farmerItems->count() - 2 }}
                                            produk lainnya</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-bold text-zinc-900">Rp
                                    {{ number_format($farmerSubtotal, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">dari {{ $farmerItems->count() }} item</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($order->status === 'paid' || $order->status === 'completed')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $order->status === 'completed' ? 'Selesai' : 'Lunas' }}
                                    </span>
                                @elseif($order->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Pending
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                                {{ $order->created_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button wire:click="openViewModal({{ $order->id }})"
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
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <p class="text-zinc-500 font-medium mb-2">Belum ada pesanan</p>
                                <p class="text-xs text-zinc-400">Pesanan akan muncul di sini saat ada yang membeli
                                    produk Anda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden divide-y divide-zinc-200">
            @forelse($orders as $order)
                @php
                    $farmerItems = $order->orderItems->filter(function ($item) use ($petaniProfile) {
                        return $item->product && $item->product->petani_profile_id == $petaniProfile->id;
                    });
                    $farmerSubtotal = $farmerItems->sum('subtotal');
                @endphp
                <div wire:key="order-mobile-{{ $order->id }}" class="p-4 hover:bg-zinc-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <span class="text-sm font-bold text-primary-600">#{{ $order->invoice_number }}</span>
                            <p class="text-xs text-zinc-500 mt-1">
                                {{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                        @if ($order->status === 'paid' || $order->status === 'completed')
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $order->status === 'completed' ? 'Selesai' : 'Lunas' }}
                            </span>
                        @elseif($order->status === 'pending')
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                        @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Dibatalkan</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="text-sm font-semibold text-zinc-900">{{ $order->user->name }}</p>
                        <p class="text-xs text-zinc-500">{{ $farmerItems->count() }} produk saya</p>
                        <p class="text-sm font-bold text-zinc-900 mt-1">Rp
                            {{ number_format($farmerSubtotal, 0, ',', '.') }}</p>
                    </div>
                    <button wire:click="openViewModal({{ $order->id }})"
                        class="w-full px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-100 transition-colors">
                        Lihat Detail
                    </button>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-zinc-300 mb-4 mx-auto" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <p class="text-zinc-500 font-medium mb-2">Belum ada pesanan</p>
                    <p class="text-xs text-zinc-400">Pesanan akan muncul di sini saat ada yang membeli produk Anda</p>
                </div>
            @endforelse
        </div>

        @if ($orders->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200">
                {{ $orders->links() }}
            </div>
        @endif
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

                <!-- Center alignment helper -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal panel -->
                <div class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
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
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Detail Pesanan #{{ $selectedOrder->invoice_number }}
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
                    <div class="px-6 py-5 max-h-[calc(100vh-200px)] overflow-y-auto">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Left Column - Order Info -->
                            <div>
                                <div class="mb-4 pb-4 border-b border-zinc-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-zinc-600">Nomor Pesanan</span>
                                        <span
                                            class="text-sm font-bold text-primary-600">#{{ $selectedOrder->invoice_number }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-zinc-600">Status Pembayaran</span>
                                        @if ($selectedOrder->status === 'paid' || $selectedOrder->status === 'completed')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $selectedOrder->status === 'completed' ? 'Selesai' : 'Lunas' }}
                                            </span>
                                        @elseif($selectedOrder->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Pending
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Dibatalkan</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-zinc-700 mb-3">Informasi Pembeli</h4>
                                    <div class="bg-zinc-50 rounded-lg p-3 space-y-2">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-zinc-400 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span
                                                class="text-sm text-zinc-900">{{ $selectedOrder->user->name }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-zinc-400 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span
                                                class="text-sm text-zinc-900">{{ $selectedOrder->user->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-zinc-700 mb-3">Alamat Pengiriman</h4>
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-sm text-zinc-900">
                                            {{ $selectedOrder->shipping_address ?? 'Tidak ada alamat' }}</p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-700 mb-3">Tanggal Pesanan</h4>
                                    <div class="bg-zinc-50 rounded-lg p-3">
                                        <p class="text-sm text-zinc-900">
                                            {{ $selectedOrder->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Products -->
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-700 mb-3">Produk Saya yang Dipesan</h4>
                                <div class="space-y-3 mb-4">
                                    @foreach ($myOrderItems as $item)
                                        <div class="flex items-start space-x-3 bg-zinc-50 rounded-lg p-3">
                                            @if ($item->product->image_path)
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
                                                <h5 class="text-sm font-semibold text-zinc-900">
                                                    {{ $item->product->name }}</h5>
                                                <p class="text-xs text-zinc-500 mb-1">
                                                    {{ $item->product->category->name ?? 'Kategori tidak tersedia' }}
                                                </p>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xs text-zinc-600">{{ $item->quantity }} x Rp
                                                        {{ number_format($item->unit_price, 0, ',', '.') }}</span>
                                                    <span class="text-sm font-bold text-zinc-900">Rp
                                                        {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Total from farmer's products -->
                                <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-zinc-600">Total Item Saya</span>
                                        <span class="text-sm font-semibold text-zinc-900">{{ $myOrderItems->count() }}
                                            produk</span>
                                    </div>
                                    <div class="flex items-center justify-between pt-2 border-t border-primary-200">
                                        <span class="text-sm font-bold text-zinc-700">Subtotal Pendapatan Saya</span>
                                        <span class="text-lg font-bold text-primary-600">Rp
                                            {{ number_format($myOrderItems->sum('subtotal'), 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                @if ($selectedOrder->paymentProof)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-semibold text-zinc-700 mb-3">Bukti Pembayaran</h4>
                                        <div class="relative group">
                                            <img src="{{ Storage::url($selectedOrder->paymentProof->image_path) }}"
                                                alt="Bukti Pembayaran"
                                                class="w-full rounded-lg border border-zinc-200">
                                            @if ($selectedOrder->paymentProof->verified_at)
                                                <div
                                                    class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-lg text-xs font-semibold flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Terverifikasi
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-lg hover:bg-zinc-50 transition-colors">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
