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
<form action="{{ route('checkout.store') }}" method="POST" class="w-full md:w-1/2 bg-white p-8 rounded-lg shadow space-y-6">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity ?? 1 }}">

    <h3 class="text-2xl font-semibold text-center mb-6 text-gray-800">Delivery Information</h3>

    <div>
        <label class="block font-medium mb-1">Address <span class="text-red-500">*</span></label>
        <input type="text" name="address" value="{{ old('address') }}"
               class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500"
               required>
    </div>

    <div>
        <label class="block font-medium mb-1">Phone Number <span class="text-red-500">*</span></label>
        <input type="number" name="phone_number" value="{{ old('phone_number') }}"
               class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500"
               required>
    </div>

    <div>
        <label class="block font-medium mb-1">Total Amount</label>
        <p class="text-lg font-semibold text-gray-800">Rs. {{ $product->price * ($quantity ?? 1) }}</p>
    </div>



    <div>
        <label class="block font-semibold mb-1 text-gray-800">Payment Method <span class="text-red-500">*</span></label>
        <select name="payment_method"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                required>
            <option value="">Select method</option>
            <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash</option>
            <option value="skypay" {{ old('payment_method') == 'skypay' ? 'selected' : '' }}>Skypay</option>
        </select>
    </div>

    <button type="submit"
            class="w-full bg-[#BD806B] hover:bg-[#C4957A] text-white text-lg py-3 rounded-lg shadow-md transition">
        Confirm Pay
    </button>
</form>
