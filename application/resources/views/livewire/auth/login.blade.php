<x-layouts.auth>
    <div class="flex flex-col gap-6 animate-fadeIn">
        <!-- Header -->
        <div class="text-center space-y-2 mb-2">
            <h1 class="text-2xl md:text-3xl font-bold text-gradient">Selamat Datang Kembali</h1>
            <p class="text-sm text-zinc-600">Masuk untuk melanjutkan ke KawanHijau</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4" id="login-form">
            @csrf

            <!-- Email Address -->
            <div>
                <flux:input name="email" label="Alamat Email" :value="old('email')" type="email" required autofocus
                    autocomplete="email" placeholder="contoh@email.com" />
            </div>

            <!-- Password -->
            <div class="relative">
                <flux:input name="password" label="Kata Sandi" type="password" required autocomplete="current-password"
                    placeholder="Masukkan kata sandi Anda" viewable />

                @if (Route::has('password.request'))
                    <flux:link
                        class="absolute top-0 right-0 text-xs font-medium text-primary-600 hover:text-primary-700 hover:underline transition-colors"
                        :href="route('password.request')" wire:navigate>
                        Lupa kata sandi?
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <flux:checkbox name="remember" :checked="old('remember')" id="remember-checkbox" />
                <label for="remember-checkbox" class="ml-2 text-sm text-zinc-600 cursor-pointer select-none">
                    Ingat saya
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <flux:button variant="primary" type="submit"
                    class="w-full bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 py-3 text-base rounded-lg"
                    id="login-btn">
                    <span id="login-text">Masuk</span>
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <!-- Divider -->
            <div class="relative my-2">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-200"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-white text-zinc-500">Belum punya akun?</span>
                </div>
            </div>

            <!-- Register Link -->
            <flux:link :href="route('register')" wire:navigate
                class="text-center text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors py-2">
                Daftar sekarang
            </flux:link>
        @endif
    </div>
</x-layouts.auth>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('login-form');
        const btn = document.getElementById('login-btn');
        const btnText = document.getElementById('login-text');
        const spinner = document.getElementById('login-spinner');

        // Reset button state on page load (in case of back navigation)
        btn.disabled = false;
        btnText.classList.remove('hidden');
        spinner.classList.add('hidden');
        btn.classList.remove('opacity-75', 'cursor-not-allowed');

        form.addEventListener('submit', function(e) {
            // Only disable if not already processing
            if (!btn.disabled) {
                btn.disabled = true;
                btnText.classList.add('hidden');
                spinner.classList.remove('hidden');
                btn.classList.add('opacity-75', 'cursor-not-allowed');
            }
        });

        // Add input focus animations
        const inputs = form.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.group').classList.add('scale-[1.01]');
            });
            input.addEventListener('blur', function() {
                this.closest('.group').classList.remove('scale-[1.01]');
            });
        });
    });
</script>
