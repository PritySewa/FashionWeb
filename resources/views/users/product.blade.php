@extends('template')
@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">

        <!-- Product Card -->
        <div class="bg-white rounded-xl shadow-lg p-8 grid grid-cols-1 md:grid-cols-2 gap-10 items-start border border-gray-300">

            <!-- Product Image -->
            <div class="rounded-lg overflow-hidden shadow-md">
                <img src="{{ $products->thumb_images_url}}"
                     class="w-full h-96 object-cover rounded-lg"
                     alt="{{ $products->title }}">
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <h1 class="text-3xl font-bold text-gray-900">{{ $products->title }}</h1>
                <p class="text-2xl text-[#BD806B] font-semibold">Rs. {{ $products->price }}</p>
                <p class="text-sm text-gray-600">Stock: {{ $products->stock }}</p>
                <p class="text-sm text-gray-600">Color: {{ $products->color }}</p>

                <!-- Quantity Input -->
                <div>
                    <label for="quantity" class="block text-sm font-medium mb-1">Quantity</label>
                    <input type="number" id="quantity" value="1" min="1" max="{{ $products->stock }}"
                           class="w-24 border border-gray-400 rounded-md p-2 text-lg text-center font-medium focus:ring-2 focus:ring-[#BD806B] focus:border-[#BD806B]"
                           oninput="calculateTotal()">
                </div>

                <!-- Total Price -->
                <p class="text-lg font-semibold text-green-700">Total: Rs. <span id="total">{{ $products->price }}</span></p>

                <!-- Action Buttons -->
                <div class="flex space-x-4 mt-4">
                    <form method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <input type="hidden" name="quantity" id="formQuantity" value="1">
                        <input type="hidden" name="color" id="formColor" value="">
                        <button type="submit"
                                class="bg-[#BD806B] hover:bg-[#C4957A] text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition">
                            Add to Cart
                        </button>
                    </form>

                    <form method="GET" action="{{ route('buy.now') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <input type="hidden" name="quantity" id="hidden-quantity">
                        <button type="submit"
                                class="bg-[#77665E] hover:bg-[#8A776E] text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition">
                            Buy Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--    @include('users.payment.buy', ['product' => $product, 'quantity' => $quantity])--}}
{{--    <x-users-buy :product="$product" :quantity="$quantity" />--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const price = {{ $products->price }};

        $(document).on('change', '#quantity', function () {
            let value = this.value;
            document.getElementById('hidden-quantity').value = value;
        });

        function calculateTotal() {
            const qty = document.getElementById('quantity').value;
            document.getElementById('total').innerText = (qty * price).toFixed(2);
        }

        function syncFormInputs() {
            document.getElementById('formQuantity').value = document.getElementById('quantity').value;
            document.getElementById('formColor').value = document.getElementById('color').value;
        }
    </script>
@endsection
