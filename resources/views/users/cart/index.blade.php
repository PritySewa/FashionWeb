@extends('template')
@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mt-6">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Product</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Quantity</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Price</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Total</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $item)
                <tr class="border-t">
                    <td class="px-6 py-4">
                        <img src="{{  $item->thumb_images_url }}" width="100" class="rounded">
                    </td>
                    <td class="px-6 py-4">{{ $item->product_title }}</td>
                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                    <td class="px-6 py-4">${{ $item->product_price }}</td>
                    <td class="px-6 py-4">${{ $item->total_price }}</td>
                    <td class="px-6 py-4">

                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
