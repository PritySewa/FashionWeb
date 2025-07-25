@extends('template')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Your Shopping Cart</h1>
            <span class="text-gray-600">
                <span id="cart-item-count">{{ $cartItems->sum('quantity') }}</span>
                {{ Str::plural('item', $cartItems->sum('quantity')) }}
            </span>
        </div>

        @if($cartItems->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Your cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to add items to your cart</p>
                <div class="mt-6">
                    <a href="{{ route('collection') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#BD806B] hover:bg-[#a36d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @else
            <!-- Bulk Delete Form (hidden, will be populated by JavaScript) -->
                <form id="bulk-delete-form" method="POST" action="{{ route('cart.bulkDelete') }}">
                    @csrf
                    @method('DELETE')
                </form>

                <div class="flex flex-col lg:flex-row gap-6">

                    <!-- 🛒 Left: Cart Section -->
                    <div class="w-full lg:w-2/3">
                        <form id="checkout-form" method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()">
                            @csrf
                            <input type="hidden" name="selected_items" id="selected-items-input">

                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <!-- Bulk Actions Bar -->
                                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="select-all" class="h-4 w-4 text-[#BD806B] rounded border-gray-300 focus:ring-[#BD806B]">
                                        <label for="select-all" class="ml-2 text-sm text-gray-700">Select all</label>
                                    </div>
                                    <button type="button" id="delete-selected" class="btn inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700" >
                                        <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove Selected
                                    </button>
                                </div>

                                <!-- Cart Items Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($cartItems as $item)
                                            <tr class="hover:bg-gray-50 transition-colors" data-item-id="{{ $item->id }}">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <input type="checkbox" class="cart-checkbox" value="{{ $item->id }}">
                                                        <div class="flex-shrink-0 h-20 w-20">
                                                            <img class="h-full w-full rounded-md object-cover" src="{{ $item->thumb_images_url }}" alt="{{ $item->product_title }}">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $item->product_title }}</div>
                                                            <div class="text-sm text-gray-500">Color: {{ $item->product->color }}</div>
                                                            <div class="text-sm text-gray-500">Size: {{ $item->product->size }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    Rs. {{ number_format($item->product_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <form class="update-quantity-form" data-item-id="{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="quantity-selector">
                                                            <button type="button" class="quantity-btn decrease">
                                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                </svg>
                                                            </button>
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input">
                                                            <button type="button" class="quantity-btn increase">
                                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 item-total">
                                                    Rs. {{ number_format($item->total_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <form class="delete-item-form" action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Cart Summary -->
                                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div class="text-right">
                                            <div class="text-base text-gray-600">
                                                Subtotal:
                                                <span class="text-xl font-bold text-gray-900 ml-2" id="cart-total">
                                        Rs. {{ number_format($cartItems->sum('total_price'), 2) }}
                                    </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">Shipping and taxes calculated at checkout</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                                <a href="{{ route('collection') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                                    Continue Shopping
                                </a>
                                <form method="GET" action="{{ route('buy.now') }}">
                                    @csrf

                                    @foreach ($cartItems as $item)
                                        <input type="hidden" name="product_ids[]" value="{{ $item->product_id }}">
                                        <input type="hidden" name="quantities[{{ $item->product_id }}]" value="{{ $item->quantity }}">
                                    @endforeach

                                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#BD806B] hover:bg-[#a36d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                                        Proceed to Checkout (Selected Items)
                                    </button>
                                </form>

                            </div>
                        </form>
                        @endif
                    </div>

                    <!-- 💳 Right: Payment Section -->
                    <div class="w-full lg:w-1/3 bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-lg font-bold mb-4">Payment Details</h2>

                        <!-- Payment Form -->
                        <form action="{{ route('orders.store') }}" method="POST" class="w-full md:w-1/2 bg-white p-8 rounded-lg shadow space-y-6">
                            @csrf

                            <!-- ✅ Hidden fields for all cart items -->
                            @foreach ($cartItems as $item)
                                <input type="hidden" name="product_ids[]" value="{{ $item->product_id }}">
                                <input type="hidden" name="quantities[{{ $item->product_id }}]" value="{{ $item->quantity }}">
                            @endforeach

                            <h3 class="text-2xl font-semibold text-center mb-6 text-gray-800">Delivery Information</h3>

                            <!-- Address -->
                            <div>
                                <label class="block font-medium mb-1">Address <span class="text-red-500">*</span></label>
                                <input type="text" name="address" value="{{ old('address') }}"
                                       class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                       required>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label class="block font-medium mb-1">Phone Number <span class="text-red-500">*</span></label>
                                <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                       class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                       required>
                            </div>

                            <!-- Total Amount (Display Only) -->
                            <div>
                                <label class="block font-medium mb-1">Total Amount</label>
                                <p class="text-lg font-semibold text-gray-800">
                                    Rs. {{ $cartItems->sum(fn($item) => $item->quantity * $item->product->price) }}
                                </p>
                            </div>

                            <!-- Paid Amount -->
                            <div>
                                <label class="block font-medium mb-1">Paid Amount <span class="text-red-500">*</span></label>
                                <input type="number" name="paid_amount" value="{{ old('paid_amount') }}"
                                       class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                       required>
                            </div>

                            <!-- Payment Method -->
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

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="w-full bg-[#BD806B] hover:bg-[#C4957A] text-white text-lg py-3 rounded-lg shadow-md transition">
                                Confirm Pay
                            </button>
                        </form>
                    </div>

                </div>
    </div>


            <style>
            .quantity-selector {
                @apply flex items-center border border-gray-300 rounded-md overflow-hidden;
            }
            .quantity-btn {
                @apply h-8 w-8 flex items-center justify-center bg-white text-gray-600 hover:bg-gray-50 focus:outline-none;
            }
            .quantity-input {
                @apply w-12 h-8 text-center border-x border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#BD806B];
                -moz-appearance: textfield;
            }
            .quantity-input::-webkit-outer-spin-button,
            .quantity-input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const deleteSelectedBtn = document.getElementById('delete-selected');
                    const bulkDeleteForm = document.getElementById('bulk-delete-form');
                    const cartCheckboxes = document.querySelectorAll('.cart-checkbox');

                    if (deleteSelectedBtn && bulkDeleteForm && cartCheckboxes.length) {
                        deleteSelectedBtn.addEventListener('click', function () {
                            const selected = Array.from(cartCheckboxes).filter(cb => cb.checked);

                            if (selected.length === 0) {
                                alert('Please select at least one item to delete.');
                                return;
                            }

                            // Clear old hidden inputs if any
                            bulkDeleteForm.querySelectorAll('input[name="item_ids[]"]').forEach(el => el.remove());

                            // Add selected IDs as hidden inputs
                            selected.forEach(cb => {
                                const hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'item_ids[]';
                                hiddenInput.value = cb.value;
                                bulkDeleteForm.appendChild(hiddenInput);
                            });

                            // Submit the form
                            bulkDeleteForm.submit();
                        });
                    } else {
                        console.error("Delete button, form, or checkboxes not found.");
                    }
                });
            </script>

    </div>
@endsection
