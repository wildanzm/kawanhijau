<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Dashboard Petani</h1>
                <p class="text-sm text-zinc-600 mt-1">
                    Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!
                    @if ($petaniProfile)
                        <span class="text-primary-600">{{ $petaniProfile->farm_name }}</span>
                    @endif
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <div class="px-3 py-1.5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200">
                    <span class="text-xs font-semibold text-green-700">{{ now()->translatedFormat('F Y') }}</span>
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
                    <p class="text-xs text-amber-800 mt-1">Silakan lengkapi profil petani Anda untuk mulai menjual
                        produk.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Products Widget -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Total Produk</p>
                    <p class="text-3xl font-bold text-zinc-900">{{ number_format($totalProducts) }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Semua produk yang terdaftar</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Orders Widget -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Total Pesanan</p>
                    <p class="text-3xl font-bold text-zinc-900">{{ number_format($totalOrders) }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Pesanan bulan ini</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Sales Widget -->
        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-zinc-600 mb-1">Total Penjualan</p>
                    <p class="text-3xl font-bold text-zinc-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    <p class="text-xs text-zinc-500 mt-2">Penjualan bulan ini</p>
                </div>
                <div
                    class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
