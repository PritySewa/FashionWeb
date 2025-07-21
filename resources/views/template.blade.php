<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pretty Aura')</title>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="antialiased bg-[#fdf6f0]  text-gray-800">

<!-- Header -->
<header class="sticky top-0 z-50 bg-[#fdf6f0]">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <a href="/" class="text-4xl font-bold text-gray-800 hover:text-indigo-800 transition-colors">
                Pretty Aura
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="/collection" class="hover:text-indigo-600 transition">Collection</a>
                <a href="/aboutus" class="hover:text-indigo-600 transition">About Us</a>
            </nav>

            <!-- Search Bar -->
            <form action="{{ route('products.search') }}" method="GET" class="hidden md:flex items-center">
                <input type="text" name="query" id="search"
                       placeholder="Search products..."
                       class="form-input border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </form>

            @auth
            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-indigo-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-1.293 1.293a1 1 0 001.414 1.414L9 14h6l1.293 1.293a1 1 0 001.414-1.414L17 13M9 21h6a2 2 0 100-4H9a2 2 0 100 4z"/>
                    </svg>
                </a>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center text-gray-500 hover:text-indigo-600 transition focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8 rounded-full bg-gray-200 p-1"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register -->
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium hover:text-indigo-600 transition">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-100 border-t border-gray-300 py-6 mt-10 text-center text-gray-600">
    <div class="max-w-7xl mx-auto px-4">
        <p>&copy; 2025 Pretty Aura. All rights reserved.</p>
    </div>
</footer>
<script>
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();

            if (query.length === 0) {
                $('#searchResults').html('');
                return;
            }

            $.ajax({
                url: '{{ route("products.search") }}',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    let html = '';

                    if (data.length === 0) {
                        html = '<p class="text-gray-500">No products found.</p>';
                    } else {
                        data.forEach(function (product) {
                            html += `
                                <div class="p-4 border-b">
                                    <h4 class="text-lg font-semibold">${product.title}</h4>
                                    <p class="text-sm text-gray-600">${product.description}</p>
                                    <span class="text-green-600 font-bold">Rs.${product.price}</span>
                                </div>
                            `;
                        });
                    }

                    $('#searchResults').html(html);
                }
            });
        });
    });
</script>
</body>
</html>
