<x-layouts.auth>
    <div class="flex flex-col gap-6 animate-fadeIn">
        <!-- Header -->
        <div class="text-center space-y-2 mb-2">
            <h1 class="text-2xl md:text-3xl font-bold text-gradient">Buat Akun Baru</h1>
            <p class="text-sm text-zinc-600">Bergabunglah dengan KawanHijau dan mulai perjalanan hijau Anda</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4" id="register-form">
            @csrf

            <!-- Role Selection -->
            <x-role-selector name="role" :selected="old('role', 'user')" />

            <!-- Name -->
            <div>
                <flux:input name="name" label="Nama Lengkap" :value="old('name')" type="text" required autofocus
                    autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
            </div>

            <!-- Email Address -->
            <div>
                <flux:input name="email" label="Alamat Email" :value="old('email')" type="email" required
                    autocomplete="email" placeholder="contoh@email.com" />
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:input name="password" label="Kata Sandi" type="password" required autocomplete="new-password"
                        placeholder="Min. 8 karakter" viewable />
                </div>

                <!-- Confirm Password -->
                <div>
                    <flux:input name="password_confirmation" label="Konfirmasi Kata Sandi" type="password" required
                        autocomplete="new-password" placeholder="Ulangi kata sandi" viewable />
                </div>
            </div>

            <!-- Petani Additional Fields -->
            <div id="petani-fields" style="display: {{ old('role') === 'petani' ? 'block' : 'none' }};"
                class="space-y-4 p-5 rounded-xl bg-gradient-to-br from-accent-50 to-cream-50 border-2 border-accent-200 animate-slideDown">
                <div class="flex items-center gap-2 mb-2">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-br from-accent-400 to-secondary-500 flex items-center justify-center shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-zinc-900">Informasi Petani</h3>
                </div>

                <!-- Farm Name -->
                <div>
                    <flux:input name="farm_name" label="Nama Toko" :value="old('farm_name')" type="text"
                        placeholder="contoh: Toko Petani" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Phone Number -->
                    <div>
                        <flux:input name="phone_number" label="Nomor Telepon" :value="old('phone_number')"
                            type="tel" autocomplete="tel" placeholder="08XXXXXXXXXX" />
                    </div>

                    <!-- City -->
                    <div>
                        <flux:input name="city" label="Kota" :value="old('city')" type="text"
                            placeholder="contoh: Bandung" />
                    </div>
                </div>

                <!-- Farm Address -->
                <div>
                    <flux:textarea name="farm_address" label="Alamat Lengkap Lahan" :value="old('farm_address')"
                        rows="3" placeholder="Masukkan alamat lengkap lahan Anda" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Farm Size -->
                    <div>
                        <flux:input name="farm_size" label="Luas Lahan (hektar)" :value="old('farm_size')"
                            type="number" step="0.01" min="0" placeholder="contoh: 2.5" />
                    </div>

                    <!-- Farming Experience -->
                    <div>
                        <flux:select name="farming_experience" label="Pengalaman Bertani">
                            <option value="">Pilih tingkat pengalaman</option>
                            <option value="beginner" {{ old('farming_experience') === 'beginner' ? 'selected' : '' }}>
                                Pemula
                                (< 1 tahun)</option>
                            <option value="intermediate"
                                {{ old('farming_experience') === 'intermediate' ? 'selected' : '' }}>Menengah (1-5
                                tahun)
                            </option>
                            <option value="experienced"
                                {{ old('farming_experience') === 'experienced' ? 'selected' : '' }}>
                                Berpengalaman (5-10 tahun)</option>
                            <option value="expert" {{ old('farming_experience') === 'expert' ? 'selected' : '' }}>Ahli
                                (> 10
                                tahun)</option>
                        </flux:select>
                    </div>
                </div>

                <!-- Bio -->
                <div>
                    <flux:textarea name="bio" label="Bio/Deskripsi Singkat" :value="old('bio')" rows="3"
                        placeholder="Ceritakan sedikit tentang Anda dan lahan pertanian Anda..." />
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start gap-2 p-3 rounded-lg hover:bg-zinc-50 transition-colors cursor-pointer">
                <flux:checkbox name="terms" required id="terms-checkbox" />
                <label for="terms-checkbox" class="text-sm text-zinc-600 -mt-0.5 cursor-pointer select-none">
                    Saya setuju dengan
                    <a href="#" class="text-primary-600 hover:text-primary-700 font-medium hover:underline">Syarat
                        dan Ketentuan</a>
                    serta
                    <a href="#"
                        class="text-primary-600 hover:text-primary-700 font-medium hover:underline">Kebijakan
                        Privasi</a>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <flux:button type="submit" variant="primary"
                    class="w-full bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white font-semibold shadow-lg hover:shadow-xl transition-all duration-300 py-3 text-base rounded-lg"
                    id="register-btn">
                    <span id="register-text">Buat Akun</span>
                </flux:button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative my-2">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-zinc-200"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-3 bg-white text-zinc-500">Sudah punya akun?</span>
            </div>
        </div>

        <!-- Login Link -->
        <flux:link :href="route('login')" wire:navigate
            class="text-center text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors py-2">
            Masuk ke akun Anda
        </flux:link>
    </div>
</x-layouts.auth>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('register-form');
        const btn = document.getElementById('register-btn');
        const btnText = document.getElementById('register-text');
        const spinner = document.getElementById('register-spinner');

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
    });
</script>
