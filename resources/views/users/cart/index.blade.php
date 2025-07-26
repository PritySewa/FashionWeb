
@extends('template')
@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-light text-gray-800">Your Shopping Cart</h1>
                <span class="text-gray-500 text-sm">
                    <span id="cart-item-count">{{ $cartItems->sum('quantity') }}</span>
                    {{ Str::plural('item', $cartItems->sum('quantity')) }}
                </span>
            </div>
            <a href="{{ route('collection') }}" class="text-sm text-[#BD806B] hover:text-[#a36d5a] flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Continue Shopping
            </a>
        </div>

        @if($cartItems->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-gray-100">
                <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-light text-gray-700">Your cart is empty</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to add items to your cart</p>
                <div class="mt-6">
                    <a href="{{ route('collection') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-sm shadow-sm text-white bg-[#BD806B] hover:bg-[#a36d5a]">
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

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items Section -->
                <div class="lg:w-2/3">
                    <form id="checkout-form" method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()">
                        @csrf
                        <input type="hidden" name="selected_items" id="selected-items-input">

                        <div class="bg-white rounded-sm shadow-sm border border-gray-100">
                            <!-- Bulk Actions -->
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                                <div class="flex items-center">
                                    <input type="checkbox" id="select-all" class="h-4 w-4 text-[#BD806B] rounded border-gray-300 focus:ring-[#BD806B]">
                                    <label for="select-all" class="ml-2 text-sm text-gray-600">Select all</label>
                                </div>
                                <button type="button" id="delete-selected" class="text-xs text-red-600 hover:text-red-800 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Remove Selected
                                </button>
                            </div>

                            <!-- Cart Items Table -->
                            <div class="divide-y divide-gray-100">
                                @foreach($cartItems as $item)
                                    <div class="p-4 hover:bg-gray-50 transition-colors" data-item-id="{{ $item->id }}" data-price="{{ $item->product_price }}">
                                        <div class="flex items-start">
                                            <input type="checkbox" class="cart-checkbox mr-4 mt-5" value="{{ $item->id }}">
                                            <div class="flex-shrink-0 h-20 w-20 border border-gray-100 rounded-sm overflow-hidden">
                                                <img class="h-full w-full object-cover" src="{{ $item->thumb_images_url }}" alt="{{ $item->product_title }}">
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <h3 class="text-sm font-medium text-gray-800">{{ $item->product_title }}</h3>
                                                        <p class="text-xs text-gray-500 mt-1">Color: {{ $item->product->color }}</p>
                                                        <p class="text-xs text-gray-500">Size: {{ $item->product->size }}</p>
                                                    </div>
                                                    <form class="delete-item-form" action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-400 hover:text-red-500">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="mt-4 flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Rs. {{ number_format($item->product_price, 2) }}</span>

                                                    <form class="update-quantity-form" data-item-id="{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="flex items-center">
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input w-16 px-2 py-1 text-sm border border-gray-300 rounded-sm text-center">
                                                        </div>
                                                    </form>

                                                    <span class="text-sm font-medium text-gray-900 item-total">
                                                        Rs. {{ number_format($item->total_price, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Cart Summary -->
                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                                <div class="flex justify-end">
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">
                                            Subtotal:
                                            <span class="ml-2 text-lg font-medium text-gray-900" id="cart-summary-total">
                                                Rs. {{ number_format($cartItems->sum('total_price'), 2) }}
                                            </span>
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500">Shipping and taxes calculated at checkout</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Checkout Section -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-sm shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-light text-gray-800 mb-4">Order Summary</h2>

                        <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="source" value="cart">
                            <input type="hidden" name="selected_ids" id="selected_ids">
                            <input type="hidden" name="selected_total" id="selected_total">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <input type="text" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-sm text-sm focus:ring-[#BD806B] focus:border-[#BD806B]">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone_number" required class="w-full px-3 py-2 border border-gray-300 rounded-sm text-sm focus:ring-[#BD806B] focus:border-[#BD806B]">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                <select name="payment_method" required class="w-full px-3 py-2 border border-gray-300 rounded-sm text-sm focus:ring-[#BD806B] focus:border-[#BD806B]">
                                    <option value="">Select method</option>
                                    <option value="cash_on_delivery">Cash</option>
                                    <option value="skypay">Skypay</option>
                                </select>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Total</span>
                                    <span class="text-lg font-medium text-gray-900" id="cart-total">Rs. 0.00</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-[#BD806B] text-white py-2 rounded-sm hover:bg-[#a76d5a] text-sm font-medium">
                                Confirm & Pay
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const selectAll = document.getElementById('select-all');
            const cartSummaryTotal = document.getElementById('cart-summary-total');
            const checkoutTotal = document.getElementById('cart-total');
            const selectedIdsInput = document.getElementById('selected_ids');
            const selectedTotalInput = document.getElementById('selected_total');
            const deleteSelectedBtn = document.getElementById('delete-selected');
            const bulkDeleteForm = document.getElementById('bulk-delete-form');
            const quantityInputs = document.querySelectorAll('.quantity-input');

            function updateCartSummary() {
                let total = 0;
                let selectedIds = [];

                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        const itemContainer = cb.closest('[data-item-id]');
                        const totalElement = itemContainer.querySelector('.item-total');
                        const amount = parseFloat(totalElement.textContent.replace('Rs.', '').replace(',', '').trim());
                        total += amount;
                        selectedIds.push(cb.value);
                    }
                });

                // Update total and hidden input fields
                if (cartSummaryTotal) cartSummaryTotal.textContent = `Rs. ${total.toFixed(2)}`;
                if (checkoutTotal) checkoutTotal.textContent = `Rs. ${total.toFixed(2)}`;
                if (selectedTotalInput) selectedTotalInput.value = total.toFixed(2);
                if (selectedIdsInput) selectedIdsInput.value = selectedIds.join(',');
            }

            // Attach change listeners to all cart checkboxes
            checkboxes.forEach(cb => cb.addEventListener('change', updateCartSummary));

            // Handle "Select All" checkbox
            if (selectAll) {
                selectAll.addEventListener('change', () => {
                    checkboxes.forEach(cb => cb.checked = selectAll.checked);
                    updateCartSummary();
                });
            }

            // Handle bulk delete button
            if (deleteSelectedBtn && bulkDeleteForm && checkboxes.length) {
                deleteSelectedBtn.addEventListener('click', () => {
                    const selected = Array.from(checkboxes).filter(cb => cb.checked);

                    if (selected.length === 0) {
                        alert('Please select at least one item to delete.');
                        return;
                    }

                    // Clear any previously added hidden inputs
                    bulkDeleteForm.querySelectorAll('input[name="item_ids[]"]').forEach(el => el.remove());

                    // Add selected item IDs as hidden inputs
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
            }

            // Handle quantity input change
            quantityInputs.forEach(input => {
                input.addEventListener('change', () => {
                    const itemContainer = input.closest('[data-item-id]');
                    const price = parseFloat(itemContainer.dataset.price);
                    const quantity = parseInt(input.value);

                    if (!isNaN(price) && !isNaN(quantity)) {
                        const itemTotalElement = itemContainer.querySelector('.item-total');
                        const newTotal = price * quantity;
                        itemTotalElement.textContent = `Rs. ${newTotal.toFixed(2)}`;
                        updateCartSummary();
                    }
                });
            });

            // Initial summary update
            updateCartSummary();
        });
    </script>
@endsection
