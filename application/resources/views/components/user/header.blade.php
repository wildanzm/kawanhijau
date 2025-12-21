@php
    $cartCount = 0;
    if (auth()->check()) {
        $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
        if ($cart) {
            $cartCount = $cart->items()->sum('quantity');
        }
        $firstName = explode(' ', auth()->user()->name)[0];
    }
@endphp

<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-zinc-200 shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <!-- Logo/Brand -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <span
                        class="text-xl md:text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent transition-all duration-300 group-hover:from-primary-700 group-hover:to-secondary-700">
                        KawanHijau
                    </span>
                </a>
            </div>

            <!-- Center Navigation - Desktop Only -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-100' }}">
                    Beranda
                </a>
                <a href="{{ route('products') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('products*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-100' }}">
                    Produk
                </a>
                <a href="#"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-100' }}">
                    Tentang
                </a>
                <a href="#"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'text-primary-600 bg-primary-50' : 'text-zinc-700 hover:text-primary-600 hover:bg-zinc-100' }}">
                    Kontak
                </a>
            </div>

            <!-- Right Side - Desktop Only -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <!-- Cart Icon with Counter -->
                    <a href="{{ route('cart') }}"
                        class="relative p-2 rounded-lg text-zinc-700 hover:text-primary-600 hover:bg-zinc-100 transition-all duration-200 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full ring-2 ring-white shadow-lg">
                                {{ $cartCount > 99 ? '99+' : $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- User Greeting & Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg text-sm font-medium text-zinc-700 hover:bg-zinc-100 transition-all duration-200">
                            <span class="hidden sm:inline">Halo, <span
                                    class="font-semibold text-primary-600">{{ $firstName }}</span></span>
                            <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-zinc-200 py-2 z-50"
                            style="display: none;">
                            <div class="px-4 py-3 border-b border-zinc-100">
                                <p class="text-sm font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-zinc-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            @if (auth()->user()->hasRole(['admin', 'petani']))
                                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('petani.dashboard') }}"
                                    class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                            @endif
                            <a href="{{ route('orders') }}"
                                class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Pesanan Saya
                            </a>
                            <a href="{{ route('profile') }}"
                                class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil
                            </a>
                            <div class="border-t border-zinc-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login & Register Buttons -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-700 hover:text-primary-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Right Side - Greeting/Auth Only -->
            <div class="flex md:hidden items-center">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-1 px-3 py-2 rounded-lg text-xs font-medium text-zinc-700 hover:bg-zinc-100 transition-all duration-200">
                            <span>Halo, <span class="font-semibold text-primary-600">{{ $firstName }}</span></span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Mobile Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-zinc-200 py-2 z-50"
                            style="display: none;">
                            <div class="px-4 py-3 border-b border-zinc-100">
                                <p class="text-sm font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-zinc-500 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            @if (auth()->user()->hasRole(['admin', 'petani']))
                                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('petani.dashboard') }}"
                                    class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                            @endif
                            <a href="{{ route('orders') }}"
                                class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Pesanan Saya
                            </a>
                            <a href="{{ route('profile') }}"
                                class="flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil
                            </a>
                            <div class="border-t border-zinc-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}"
                            class="px-3 py-1.5 text-xs font-medium text-zinc-700 hover:text-primary-600 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-3 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>

<!-- Bottom Navigation - Mobile Only -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-zinc-200 shadow-lg pb-safe">
    <div class="grid grid-cols-4 gap-1 px-2 py-2">
        <!-- Home -->
        <a href="{{ route('home') }}"
            class="flex flex-col items-center justify-center py-2 px-3 rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-50' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-xs font-medium">Beranda</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products') }}"
            class="flex flex-col items-center justify-center py-2 px-3 rounded-lg transition-all duration-200 {{ request()->routeIs('products*') ? 'text-primary-600 bg-primary-50' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-50' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span class="text-xs font-medium">Produk</span>
        </a>

        <!-- Cart -->
        @auth
            <a href="{{ route('cart') }}"
                class="flex flex-col items-center justify-center py-2 px-3 rounded-lg transition-all duration-200 relative {{ request()->routeIs('cart') ? 'text-primary-600 bg-primary-50' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-50' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                @if ($cartCount > 0)
                    <span
                        class="absolute top-1 right-2 flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full">
                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                    </span>
                @endif
                <span class="text-xs font-medium">Keranjang</span>
            </a>
        @else
            <a href="{{ route('login') }}"
                class="flex flex-col items-center justify-center py-2 px-3 rounded-lg transition-all duration-200 text-zinc-600 hover:text-primary-600 hover:bg-zinc-50">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="text-xs font-medium">Keranjang</span>
            </a>
        @endauth

        <!-- About -->
        <a href="#"
            class="flex flex-col items-center justify-center py-2 px-3 rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'text-primary-600 bg-primary-50' : 'text-zinc-600 hover:text-primary-600 hover:bg-zinc-50' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-xs font-medium">Tentang</span>
        </a>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
