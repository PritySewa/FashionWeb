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
            <div class="mt-8  justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('collection') }}" class="inline-flex justify-center items-center px-5 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                    Continue Shopping
                </a>
            </div>
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
            <div class="container mx-auto -ml-8">

                <!-- Bulk Delete Form (hidden, will be populated by JavaScript) -->
                <form id="bulk-delete-form" method="POST" action="{{ route('cart.bulkDelete') }}">
                    @csrf
                    @method('DELETE')
                </form>

                <div class="container mx-auto -ml-8">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- 🛒 Left: Cart Section -->
                        <div class="w-full lg:w-5/6 ml-0">
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
                                                <tr class="hover:bg-gray-50 transition-colors" data-item-id="{{ $item->id }}" data-price="{{ $item->product_price }}">
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
                                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input w-16 text-center border border-gray-300 rounded">
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
                                                    <span class="text-xl font-bold text-gray-900 ml-2" id="cart-summary-total">
                                                        Rs. {{ number_format($cartItems->sum('total_price'), 2) }}
                                                    </span>

                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">Shipping and taxes calculated at checkout</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                <form action="{{ route('checkout.store') }}" method="POST" class="w-full md:w-1/2 bg-white p-8 rounded-lg shadow space-y-6">
                    @csrf

                    <!-- These hidden fields are important -->
                    <input type="hidden" name="source" value="cart">
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <input type="hidden" name="selected_total" id="selected_total">

                    <!-- Address -->
                    <div>
                        <label class="block font-medium mb-1">Address</label>
                        <input type="text" name="address" required class="w-full border-gray-300 rounded px-3 py-2">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block font-medium mb-1">Phone Number</label>
                        <input type="text" name="phone_number" required class="w-full border-gray-300 rounded px-3 py-2">
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="block font-semibold mb-1 text-gray-800">Payment Method <span class="text-red-500">*</span></label>
                        <select name="payment_method" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select method</option>
                            <option value="cash_on_delivery">Cash</option>
                            <option value="skypay">Skypay</option>
                        </select>
                    </div>

                    <!-- Total -->
                    <div>
                        <label class="block font-medium mb-1">Total</label>
                        <p class="text-lg font-bold" id="cart-total">Rs. 0.00</p>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full bg-[#BD806B] text-white py-2 rounded hover:bg-[#a76d5a]">
                        Confirm & Pay
                    </button>
                </form>

            </div>
        </form>

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
                                    const row = cb.closest('tr');
                                    const totalCell = row.querySelector('.item-total');
                                    const amount = parseFloat(totalCell.textContent.replace('Rs.', '').replace(',', '').trim());
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
                                const row = input.closest('tr');
                                const price = parseFloat(row.dataset.price);
                                const quantity = parseInt(input.value);

                                if (!isNaN(price) && !isNaN(quantity)) {
                                    const itemTotalCell = row.querySelector('.item-total');
                                    const newTotal = price * quantity;
                                    itemTotalCell.textContent = `Rs. ${newTotal.toFixed(2)}`;
                                    updateCartSummary();
                                }
                            });
                        });

                        // Initial summary update
                        updateCartSummary();
                    });
                </script>



@endsection
