@extends('template')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Filter Buttons -->
        <div class="flex flex-wrap gap-3 mb-6">
            @foreach(['All', 'Skirts', 'Jackets', 'Summer', 'Winter', 'Cheap', 'Trending'] as $filter)
                <button class="filter-btn px-4 py-2 rounded border text-sm font-medium
                           hover:bg-[#BD806B] hover:text-white transition"
                        data-filter="{{ strtolower($filter) }}">
                    {{ $filter }}
                </button>
            @endforeach
        </div>

        <!-- Product Grid -->
        <div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow hover:shadow-md transition p-4 space-y-2">
                    <img src="{{ asset('storage/' . $product->thumb_images_url) }}" alt="{{ $product->title }}"
                         class="w-full h-48 object-cover rounded-md">

                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                    <p class="text-sm text-gray-500">{{ Str::limit($product->description, 60) }}</p>

                    <div class="flex justify-between items-center">
                        <span class="text-[#BD806B] font-bold text-lg">Rs. {{ $product->price }}</span>
                        <span class="text-xs text-gray-600">Stock: {{ $product->stock }}</span>
                    </div>

                    <div class="text-sm text-gray-600">Color: {{ $product->color }}</div>

                    <button class="mt-2 w-full bg-[#BD806B] text-white py-1.5 rounded hover:bg-[#a96d5c] transition">
                        Add to Cart
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
