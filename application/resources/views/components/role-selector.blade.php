@props(['name' => 'role', 'selected' => 'user'])

<div class="space-y-3 animate-fadeIn">
    <label class="block text-sm font-medium text-zinc-900 mb-1">
        Daftar sebagai <span class="text-red-500">*</span>
    </label>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- User Role -->
        <label
            class="role-card group relative flex cursor-pointer rounded-xl border-2 p-4 transition-all duration-200 hover:shadow-md
            {{ $selected === 'user' ? 'border-primary-500 bg-gradient-to-br from-primary-50 to-secondary-50 shadow-sm ring-2 ring-primary-200' : 'border-zinc-200 bg-white hover:border-primary-300' }}">
            <input type="radio" name="{{ $name }}" value="user" class="peer sr-only"
                {{ $selected === 'user' ? 'checked' : '' }} onchange="togglePetaniFields(false)">
            <div class="flex items-start w-full gap-3">
                <div
                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 text-white flex-shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-105">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-zinc-900 mb-1">Pembeli</p>
                    <p class="text-sm text-zinc-600 leading-relaxed">Jelajahi dan beli produk pertanian</p>
                </div>
            </div>
            <!-- Active indicator -->
            <div
                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-b-lg {{ $selected === 'user' ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-200">
            </div>
        </label>

        <!-- Petani Role -->
        <label
            class="role-card group relative flex cursor-pointer rounded-xl border-2 p-4 transition-all duration-200 hover:shadow-md
            {{ $selected === 'petani' ? 'border-primary-500 bg-gradient-to-br from-primary-50 to-secondary-50 shadow-sm ring-2 ring-primary-200' : 'border-zinc-200 bg-white hover:border-primary-300' }}">
            <input type="radio" name="{{ $name }}" value="petani" class="peer sr-only"
                {{ $selected === 'petani' ? 'checked' : '' }} onchange="togglePetaniFields(true)">
            <div class="flex items-start w-full gap-3">
                <div
                    class="flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-accent-500 to-secondary-500 text-white flex-shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-105">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-zinc-900 mb-1">Petani</p>
                    <p class="text-sm text-zinc-600 leading-relaxed">Jual produk hasil pertanian Anda</p>
                </div>
            </div>
            <!-- Active indicator -->
            <div
                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-accent-500 to-secondary-500 rounded-b-lg {{ $selected === 'petani' ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-200">
            </div>
        </label>
    </div>

    @error($name)
        <p class="text-sm text-red-600 mt-2 flex items-center gap-1 animate-shake">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>

<script>
    function togglePetaniFields(show) {
        const petaniFields = document.getElementById('petani-fields');
        if (petaniFields) {
            if (show) {
                petaniFields.style.display = 'block';
                setTimeout(() => {
                    petaniFields.classList.add('animate-slideDown');
                }, 10);
                petaniFields.querySelectorAll('input, textarea, select').forEach(field => {
                    field.setAttribute('required', 'required');
                });
            } else {
                petaniFields.classList.remove('animate-slideDown');
                setTimeout(() => {
                    petaniFields.style.display = 'none';
                }, 300);
                petaniFields.querySelectorAll('input, textarea, select').forEach(field => {
                    field.removeAttribute('required');
                    field.value = '';
                });
            }
        }

        // Update role card active states
        document.querySelectorAll('.role-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            const indicator = card.querySelector('.absolute.bottom-0');

            if (radio.checked) {
                card.classList.add('border-primary-500', 'bg-gradient-to-br', 'from-primary-50',
                    'to-secondary-50', 'shadow-sm', 'ring-2', 'ring-primary-200');
                card.classList.remove('border-zinc-200', 'bg-white');
                if (indicator) indicator.classList.remove('opacity-0');
                if (indicator) indicator.classList.add('opacity-100');
            } else {
                card.classList.remove('border-primary-500', 'bg-gradient-to-br', 'from-primary-50',
                    'to-secondary-50', 'shadow-sm', 'ring-2', 'ring-primary-200');
                card.classList.add('border-zinc-200', 'bg-white');
                if (indicator) indicator.classList.add('opacity-0');
                if (indicator) indicator.classList.remove('opacity-100');
            }
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const selectedRole = document.querySelector('input[name="role"]:checked');
        if (selectedRole) {
            togglePetaniFields(selectedRole.value === 'petani');
        }

        // Add click animation to role cards
        const roleCards = document.querySelectorAll('.role-card');
        roleCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove active state from all cards
                roleCards.forEach(c => {
                    c.classList.remove('ring-2', 'ring-primary-500', 'ring-offset-2');
                });
                // Add active state to clicked card
                this.classList.add('ring-2', 'ring-primary-500', 'ring-offset-2');

                // Trigger vibration on mobile devices
                if ('vibrate' in navigator) {
                    navigator.vibrate(50);
                }
            });
        });

        // Set initial active state
        const checkedCard = document.querySelector('input[name="role"]:checked');
        if (checkedCard) {
            checkedCard.closest('.role-card').classList.add('ring-2', 'ring-primary-500', 'ring-offset-2');
        }
    });
</script>
