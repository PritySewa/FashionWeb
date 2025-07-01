<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-white-50">
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-[#fdf6ec] shadow-lg rounded-xl overflow-hidden"> <!-- Cream color here -->
        <!-- Logo -->
        <div class="flex justify-center py-6">
            <a href="/" class="text-indigo-600 font-bold text-2xl">
                Pretty Aura
            </a>
        </div>

        <!-- Content Slot -->
        <div class="px-6 py-4">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>
