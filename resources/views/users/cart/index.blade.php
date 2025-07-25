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
                <form id="bulk-delete-form" method="POST" action="{{ route('cart.bulkDelete') }}">
                    @csrf
                    @method('DELETE') <!-- This converts POST to DELETE -->

                    <!-- Your checkboxes and other form elements -->

                    <button type="submit" id="delete-selected-btn" class="..." disabled>
                        Remove Selected
                    </button>
                </form>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all" class="h-4 w-4 text-[#BD806B] rounded border-gray-300 focus:ring-[#BD806B]">
                                </th>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="item_ids[]" class="cart-checkbox h-4 w-4 text-[#BD806B] rounded border-gray-300 focus:ring-[#BD806B]" value="{{ $item->id }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-20 w-20">
                                                <img class="h-full w-full rounded-md object-cover" src="{{ $item->thumb_images_url }}" alt="{{ $item->product_title }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product_title }}</div>
                                                <div class="text-sm text-gray-500">Color: {{ $item->product->color }}</div>
                                                <div class="text-sm text-gray-500">Size: {{ $item->product->size  }}</div>
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

                    <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                        <div class="flex justify-between items-center">
                            <button type="submit" id="delete-selected-btn" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" disabled>
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Remove Selected
                            </button>
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
            </form>

            <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}" class="mt-8">
                @csrf
                <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('collection') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                        Continue Shopping
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#BD806B] hover:bg-[#a36d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BD806B]">
                        Proceed to Checkout
                    </button>
                </div>
            </form>
        @endif

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
            document.addEventListener('DOMContentLoaded', function() {
                // Quantity update handlers
                document.querySelectorAll('.quantity-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const input = this.parentNode.querySelector('.quantity-input');
                        if (this.classList.contains('decrease')) {
                            if (parseInt(input.value) > 1) {
                                input.value = parseInt(input.value) - 1;
                                input.dispatchEvent(new Event('change'));
                            }
                        } else {
                            input.value = parseInt(input.value) + 1;
                            input.dispatchEvent(new Event('change'));
                        }
                    });
                });

                // AJAX quantity update
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const form = this.closest('.update-quantity-form');
                        const itemId = form.dataset.itemId;
                        const quantity = this.value;
                        this.disabled = true;

                        fetch(`/cart/${itemId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                quantity: quantity,
                                _method: 'PUT'
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update item total
                                    const row = form.closest('tr');
                                    row.querySelector('.item-total').textContent = `Rs. ${data.item_total}`;

                                    // Update cart totals
                                    document.getElementById('cart-total').textContent = `Rs. ${data.cart_total}`;
                                    document.getElementById('cart-item-count').textContent = data.item_count;
                                }
                                this.disabled = false;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                this.disabled = false;
                            });
                    });
                });

                // Bulk delete form handling
                const bulkDeleteForm = document.getElementById('bulk-delete-form');
                const deleteSelectedBtn = document.getElementById('delete-selected-btn');

                // Toggle delete button based on selection
                function toggleDeleteButton() {
                    const anyChecked = Array.from(document.querySelectorAll('.cart-checkbox:checked')).length > 0;
                    deleteSelectedBtn.disabled = !anyChecked;
                }

                // Select all functionality
                document.getElementById('select-all').addEventListener('change', function() {
                    document.querySelectorAll('.cart-checkbox').forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    toggleDeleteButton();
                });

                // Individual checkbox functionality
                document.querySelectorAll('.cart-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', toggleDeleteButton);
                });

                // Initialize button state
                toggleDeleteButton();

                // Delete item confirmation
                document.querySelectorAll('.delete-item-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Are you sure you want to remove this item from your cart?')) {
                            e.preventDefault();
                        }
                    });
                });

                // Bulk delete confirmation
                bulkDeleteForm.addEventListener('submit', function(e) {
                    if (document.querySelectorAll('.cart-checkbox:checked').length === 0) {
                        e.preventDefault();
                        alert('Please select at least one item to remove.');
                    } else if (!confirm('Are you sure you want to remove the selected items?')) {
                        e.preventDefault();
                    }
                });

                // Checkout form handling
                document.getElementById('checkout-form').addEventListener('submit', function(e) {
                    // Add any additional validation here if needed
                    const selectedItems = Array.from(document.querySelectorAll('.cart-checkbox:checked')).length;
                    if (selectedItems === 0) {
                        e.preventDefault();
                        alert('Please select at least one item to checkout.');
                    }
                });
            });
        </script>
    </div>
@endsection
