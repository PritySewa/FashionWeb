@extends('template')
@section('content')

    @if($errors->any())
        {!! implode('', $errors->all('<div class="text-red-600 font-medium mb-2">:message</div>')) !!}
    @endif

    <div class="max-w-6xl mx-auto p-8 bg-[#FAF3E0] rounded-xl shadow-md mt-6">
        <h2 class="text-3xl font-bold mb-8 text-gray-900 text-center">Confirm Your Purchase</h2>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Card -->
            <div class="flex flex-col items-center w-full md:w-1/2 bg-white p-6 rounded-lg shadow">
                <img src="{{ $product->thumb_images_url }}" class="rounded-lg shadow w-72 md:w-96">
                <div class="text-center mt-4">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $product->title }}</h3>
                    <p class="text-lg text-gray-700">Price: Rs. {{ $product->price }}</p>
                    <p class="text-lg text-gray-700">Quantity: <span class="font-bold">{{ $quantity ?? 1 }}</span></p>
                    <p class="text-2xl font-bold text-green-600 mt-2">Total: Rs. {{ $product->price * ($quantity ?? 1) }}</p>
                </div>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('orders.store') }}" method="POST" class="w-full md:w-1/2 bg-white p-8 rounded-lg shadow space-y-6">
                @csrf

                <!-- ✅ Hidden fields -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity ?? 1 }}">

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
                    <p class="text-lg font-semibold text-gray-800">Rs. {{ $product->price * ($quantity ?? 1) }}</p>
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
@endsection
