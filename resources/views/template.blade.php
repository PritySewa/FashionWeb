<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Pretty Aura')</title>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display&display=swap"
        rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: "Inter", sans-serif;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body
    class="antialiased bg-[#EFDECD] text-gray-800"
    x-data="{ showLogin: false, showRegister: false }"
>

<!-- Header -->
<header class="sticky top-0 z-50 bg-[#fdf6f0]">
    <div class="container mx-auto px-6 lg:px-8 border border-black">
        <div class="flex items-center py-4">
            <!-- Left: Logo -->
            <div class="flex-shrink-0">
                <a
                    href="/"
                    class="text-4xl font-serif font-bold text-gray-800 hover:text-amber-800 transition-colors"
                >
                    Pretty Aura
                </a>
            </div>

            <!-- Middle: Nav + Search -->
            <div
                class="flex flex-grow justify-center items-center space-x-8 font-medium"
            >
                <nav
                    class="hidden md:flex space-x-8 text-amber-800 font-medium"
                >
                    <a
                        href="/"
                        class="hover:text-amber-800 text-m text-semibold text-black transition"
                    >Home</a
                    >
                    <a
                        href="/collection"
                        class="hover:text-amber-800 text-black text-m transition"
                    >Collection</a
                    >
                    <a
                        href="/aboutus"
                        class="hover:text-amber-800 text-m text-black transition"
                    >About Us</a
                    >
                </nav>

                <form
                    action="{{ route('products.search') }}"
                    method="GET"
                    class="hidden md:flex items-center"
                >
                    <input
                        type="text"
                        name="query"
                        id="search"
                        placeholder="Search products..."
                        value="{{ request('query') }}"
                        class="form-input border border-black rounded-md px-3 py-1 text-m focus:outline-none focus:ring-2 focus:ring-amber-800"
                    />
                </form>
            </div>

            <!-- Right: Auth -->
            <div class="flex-shrink-0 flex items-center space-x-4">
                @auth
                    <!-- Cart Icon -->
                    <a
                        href="{{ route('cart.index') }}"
                        class="text-gray-500 hover:text-indigo-600 transition"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-1.293 1.293a1 1 0 001.414 1.414L9 14h6l1.293 1.293a1 1 0 001.414-1.414L17 13M9 21h6a2 2 0 100-4H9a2 2 0 100 4z"
                            />
                        </svg>
                    </a>


                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="flex items-center text-gray-500 hover:text-indigo-600 transition focus:outline-none"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 rounded-full bg-gray-200 p-1"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                        </button>
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50"
                        >
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            @endif

                            <a
                                href="/profile"
                                class="block px-4 py-2 hover:bg-gray-100"
                            >Profile</a
                            >
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full text-left block px-4 py-2 hover:bg-gray-100"
                                >
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Trigger Login Modal -->
                    <button
                        type="button"
                        @click="showLogin = true"
                        class="px-4 py-2 rounded-md text-sm font-medium border border-black bg-white hover:text-amber-800 transition"
                    >
                        Login
                    </button>

                    @if (Route::has('register'))
                        <button
                            type="button"
                            @click="showRegister = true"
                            class="px-4 py-2 rounded-md text-sm font-medium border border-black bg-white hover:text-amber-800 transition"
                        >
                            Register
                        </button>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>

<main>@yield('content')</main>

<!-- Footer -->
<footer
    class="bg-gray-100 border-t border-gray-300 py-6 mt-10 text-center text-gray-600"
>
    <div class="max-w-7xl mx-auto px-4">
        <p>&copy; 2025 Pretty Aura. All rights reserved.</p>
    </div>
</footer>

<!-- Login Modal -->
<div
    x-cloak
    x-show="showLogin"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
>
    <div class="bg-[#EFDECD] w-full max-w-md mx- p-6 relative">
        <!-- Close Button -->
        <button
            @click="showLogin = false"
            class="absolute -top-0 -right-0 w-7 h-7 bg-white border border-gray-300 shadow text-3xl text-gray-600 hover:text-black hover:bg-gray-100 flex items-center justify-center z-50"
        >
            &times;
        </button>


        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <input
                        id="email"
                        style="color: black"
                        class="block mt-1 w-full bg-white text-black border border-black rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="email"
                        name="email"
                        required
                        autofocus
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <input
                        id="password"
                        class="block mt-1 w-full bg-white text-black border border-black rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="password"
                        name="password"
                        required
                        autofocus
                    />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember"
                        />
                        <span class="ml-2 text-sm text-gray-600"
                        >{{ __("Remember me") }}</span
                        >
                    </label>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __("Log in") }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div
    x-cloak
    x-show="showRegister"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
>
    <div
        class="bg-[#EFDECD] w-full max-w-md mx-4  p-6 relative"
    >
        <!-- Close Button -->
        <button
            @click="showRegister = false"
            class="absolute -top-0 -right-0 w-7 h-7  bg-white border border-gray-300 shadow text-xl text-gray-600 hover:text-black hover:bg-gray-100 flex items-center justify-center z-50"
        >
            &times;
        </button>


        <!-- Register Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <input
                        id="name"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="name"
                        name="name"
                        :value="old('name')"
                        required
                        autocomplete="name"
                    />
                    <x-input-error
                        :messages="$errors->get('name')"
                        class="mt-2"
                    />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <input
                        id="email"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <input
                        id="password"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="password"
                        name="password"
                        :value="old('password')"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <input
                        id="address"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="address"
                        name="address"
                        :value="old('address')"
                        required
                        autocomplete="address"
                    />
                    <x-input-error
                        :messages="$errors->get('address')"
                        class="mt-2"
                    />
                </div>

                <!-- Phone Number -->
                <div class="mt-4">
                    <x-input-label
                        for="phone_number"
                        :value="__('Phone Number')"
                    />
                    <input
                        id="phone_number"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="phone_number"
                        name="phone_number"
                        :value="old('phone_number')"
                        required
                        autocomplete="phone_number"
                    />
                    <x-input-error
                        :messages="$errors->get('phone_number')"
                        class="mt-2"
                    />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                    />
                    <input
                        id="password_confirmation"
                        class="block mt-1 w-full bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-black"
                        type="password_confirmation"
                        name="password_confirmation"
                        :value="old('password_confirmation')"
                        required
                        autocomplete="new_password"
                    />
                    <x-input-error
                        :messages="$errors->get('password_confirmation')"
                        class="mt-2"
                    />
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __("Register") }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Search Script -->
<script>
    function fetchCartQuantity() {
        fetch("/cart/quantity")
            .then(res => res.json())
            .then(data => {
                const badge = document.querySelector('.cart-count');
                if (badge) badge.textContent = data.quantity;
            })
            .catch(err => console.error("Cart count error:", err));
    }

    document.addEventListener("DOMContentLoaded", fetchCartQuantity);
</script>
<script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            let query = $(this).val();

            if (query.length === 0) {
                $("#searchResults").html("");
                return;
            }

            $.ajax({
                url: "{{ route("products.search") }}",
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let html = "";

                    if (data.length === 0) {
                        html =
                            '<p class="text-gray-500">No products found.</p>';
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

                    $("#searchResults").html(html);
                },
            });
        });
    });
</script>
</body>
</html>

