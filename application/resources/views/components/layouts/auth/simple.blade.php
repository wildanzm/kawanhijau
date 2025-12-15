<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-3px);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slideDown {
            animation: slideDown 0.4s ease-out;
        }

        .animate-shake {
            animation: shake 0.3s ease-in-out;
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite;
        }
    </style>
</head>

<body class="min-h-screen antialiased bg-gradient-to-br from-primary-50 via-cream-50 to-secondary-50 overflow-x-hidden">
    <!-- Decorative Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute top-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-primary-400/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-pulse">
        </div>
        <div class="absolute bottom-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-secondary-400/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 animate-pulse"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 sm:w-96 sm:h-96 bg-accent-400/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="relative flex min-h-svh flex-col items-center justify-center gap-4 sm:gap-6 p-4 sm:p-6 md:p-10">
        <!-- Brand Name Only -->
        <div class="flex flex-col items-center gap-2 mb-2 sm:mb-4 animate-fadeIn">
            <a href="{{ route('home') }}"
                class="group flex flex-col items-center gap-2 font-medium transition-transform hover:scale-105 duration-300"
                wire:navigate>
                <span
                    class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gradient text-center">{{ config('app.name', 'KawanHijau') }}</span>
                <span class="text-xs sm:text-sm text-zinc-600 text-center">Sahabat Hijau Anda</span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full max-w-md lg:max-w-lg xl:max-w-xl">
            <div class="card-auth backdrop-blur-sm bg-white/90 animate-fadeIn" style="animation-delay: 0.2s;">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs sm:text-sm text-zinc-500 animate-fadeIn px-4" style="animation-delay: 0.4s;">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'KawanHijau') }}. Hak Cipta Dilindungi.</p>
        </div>
    </div>
    @fluxScripts

    <!-- SweetAlert Notifications -->
    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('status') }}',
                confirmButtonColor: '#018175',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'rounded-xl shadow-lg'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#018175',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-6 py-2 rounded-lg'
                }
            });
        </script>
    @endif

    <x-validation-errors :errors="$errors" />
</body>

</html>
