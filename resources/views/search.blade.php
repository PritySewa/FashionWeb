@extends('template') {{-- or your layout file --}}
@section('content')

        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4">Search results for "{{ $query }}"</h2>

            @if($products->count())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="border p-4 rounded shadow hover:shadow-md transition">
                            <h3 class="font-semibold text-lg">{{ $product->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $product->description }}</p>
                            <span class="text-green-600 font-bold block mt-2">Rs. {{ $product->price }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No products found.</p>
            @endif
        </div>
@endsection
