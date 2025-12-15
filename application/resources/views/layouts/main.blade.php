<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'KawanHijau - Platform Pertanian' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-zinc-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <x-user.header />

        <!-- Page Content -->
        <main class="flex-1 pt-16 md:pt-20 pb-20 md:pb-0">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-user.footer />
    </div>

    @livewireScripts
</body>

</html>
