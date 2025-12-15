<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard - KawanHijau' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-zinc-50">
    @php
        $routeName = request()->route()->getName();
        $activeMenu = '';

        if (str_contains($routeName, 'dashboard')) {
            $activeMenu = 'dashboard';
        } elseif (str_contains($routeName, 'users')) {
            $activeMenu = 'users';
        } elseif (str_contains($routeName, 'categories')) {
            $activeMenu = 'categories';
        } elseif (str_contains($routeName, 'products')) {
            $activeMenu = 'products';
        } elseif (str_contains($routeName, 'orders')) {
            $activeMenu = 'orders';
        } elseif (str_contains($routeName, 'reports')) {
            $activeMenu = 'reports';
        } elseif (str_contains($routeName, 'sales')) {
            $activeMenu = 'sales';
        } elseif (str_contains($routeName, 'profile')) {
            $activeMenu = 'profile';
        } elseif (str_contains($routeName, 'settings')) {
            $activeMenu = 'settings';
        }
    @endphp

    <div class="min-h-screen flex">
        <div x-data="{ sidebarOpen: false }" class="relative">
            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
                class="lg:hidden fixed inset-0 bg-zinc-900/50 backdrop-blur-sm z-40" style="display: none;">
            </div>

            <!-- Mobile Menu Button -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-white rounded-lg shadow-lg border border-zinc-200 hover:bg-zinc-50 transition-all">
                <svg class="w-6 h-6 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Sidebar -->
            <aside x-show="sidebarOpen || window.innerWidth >= 1024"
                x-transition:enter="lg:transition-none transition-transform ease-out duration-300"
                x-transition:enter-start="-translate-x-full lg:translate-x-0" x-transition:enter-end="translate-x-0"
                x-transition:leave="lg:transition-none transition-transform ease-in duration-200"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full lg:translate-x-0"
                class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-zinc-200 shadow-xl z-50 flex flex-col">

                <!-- Logo Section -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-zinc-200">
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('petani.dashboard') }}"
                        class="flex items-center group">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h1
                                class="text-lg font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                                KawanHijau
                            </h1>
                            <p class="text-xs text-zinc-500">Dashboard</p>
                        </div>
                    </a>

                    <!-- Mobile Close Button -->
                    <button @click="sidebarOpen = false"
                        class="lg:hidden p-2 rounded-lg hover:bg-zinc-100 transition-colors">
                        <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- User Profile Card -->
                <div class="px-4 py-4 border-b border-zinc-200">
                    <div
                        class="flex items-center space-x-3 p-3 bg-gradient-to-br from-primary-50 to-secondary-50 rounded-lg">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-zinc-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-zinc-600 capitalize">
                                @if (auth()->user()->hasRole('admin'))
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-green-100 text-green-700 font-medium">
                                        Admin
                                    </span>
                                @elseif(auth()->user()->hasRole('petani'))
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full bg-green-100 text-green-700 font-medium">
                                        Petani
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
                    <!-- Dashboard - Common for All -->
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('petani.dashboard') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'dashboard' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                        <svg class="w-5 h-5 {{ $activeMenu === 'dashboard' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium text-sm">Dashboard</span>
                    </a>

                    @if (auth()->user()->hasRole('admin'))
                        <!-- Admin Menu -->
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Manajemen</p>
                        </div>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'users' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'users' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="font-medium text-sm">Pengguna</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'categories' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'categories' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="font-medium text-sm">Kategori</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'products' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'products' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="font-medium text-sm">Produk</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'orders' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'orders' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="font-medium text-sm">Pesanan</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'reports' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'reports' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="font-medium text-sm">Laporan</span>
                        </a>
                    @elseif(auth()->user()->hasRole('petani'))
                        <!-- Petani Menu -->
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Manajemen Toko
                            </p>
                        </div>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'products' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'products' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="font-medium text-sm">Produk Saya</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'orders' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'orders' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span class="font-medium text-sm">Pesanan Masuk</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'sales' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'sales' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium text-sm">Penjualan</span>
                        </a>

                        <a href=""
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'profile' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                            <svg class="w-5 h-5 {{ $activeMenu === 'profile' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium text-sm">Profil Petani</span>
                        </a>
                    @endif

                    <!-- Divider -->
                    <div class="pt-4 pb-2">
                        <div class="border-t border-zinc-200"></div>
                    </div>

                    <!-- Settings - Common -->
                    <a href=""
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 group {{ $activeMenu === 'settings' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white shadow-md' : 'text-zinc-700 hover:bg-zinc-100' }}">
                        <svg class="w-5 h-5 {{ $activeMenu === 'settings' ? 'text-white' : 'text-zinc-600 group-hover:text-primary-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium text-sm">Pengaturan</span>
                    </a>
                </nav>

                <!-- Bottom Section - Logout -->
                <div class="border-t border-zinc-200 p-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-zinc-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group w-full">
                            <svg class="w-5 h-5 text-zinc-600 group-hover:text-red-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium text-sm">Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col lg:ml-64">
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
