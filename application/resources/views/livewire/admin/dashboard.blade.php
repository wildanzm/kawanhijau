<div>
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-zinc-900 mb-2">
            Selamat Datang, <span
                class="bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">{{ auth()->user()->name }}</span>!
        </h1>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users Card -->
        <div
            class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-zinc-200 hover:border-primary-200 transition-all duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-zinc-600 mb-1">Total Pengguna</p>
                        <h3 class="text-4xl font-bold text-zinc-900 mb-2">
                            {{ number_format($totalUsers) }}
                        </h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        <!-- Total Orders Card -->
        <div
            class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-zinc-200 hover:border-secondary-200 transition-all duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-zinc-600 mb-1">Total Pesanan</p>
                        <h3 class="text-4xl font-bold text-zinc-900 mb-2">
                            {{ number_format($totalOrders) }}
                        </h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-amber-500 to-amber-600"></div>
        </div>

        <!-- Total Products Card -->
        <div
            class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-zinc-200 hover:border-accent-200 transition-all duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-zinc-600 mb-1">Total Produk</p>
                        <h3 class="text-4xl font-bold text-zinc-900 mb-2">
                            {{ number_format($totalProducts) }}
                        </h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center shadow-lg shadow-primary-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="h-1 bg-gradient-to-r from-primary-500 to-secondary-500"></div>
        </div>
    </div>
</div>
