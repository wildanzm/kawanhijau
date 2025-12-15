<footer class="bg-white border-t border-zinc-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="space-y-4">
                <h3
                    class="text-xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                    KawanHijau
                </h3>
                <p class="text-sm text-zinc-600 leading-relaxed">
                    Platform jual beli produk pertanian lokal yang menghubungkan petani dengan konsumen.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-semibold text-zinc-900 mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Beranda</a></li>
                    <li><a href="{{ route('products') }}"
                            class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Produk</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Kontak</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div>
                <h4 class="font-semibold text-zinc-900 mb-4">Informasi</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Cara
                            Berbelanja</a></li>
                    <li><a href="#"
                            class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Kebijakan Privasi</a>
                    </li>
                    <li><a href="#" class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">Syarat
                            & Ketentuan</a></li>
                    <li><a href="#" class="text-sm text-zinc-600 hover:text-primary-600 transition-colors">FAQ</a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-zinc-900 mb-4">Hubungi Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-start text-sm text-zinc-600">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-primary-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@kawanhijau.com
                    </li>
                    <li class="flex items-start text-sm text-zinc-600">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-primary-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +62 812-3456-7890
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-zinc-200">
            <p class="text-center text-sm text-zinc-600">
                &copy; {{ date('Y') }} KawanHijau. All rights reserved.
            </p>
        </div>
    </div>
</footer>
