@extends('template') {{-- or your layout file --}}
@section('content')

    <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-1xl font-sans text-gray-600 mb-9 text-center tracking-widest -mt-8">
            you searched for <br>
            <span class="text-2xl font-serif font-bold text-gray-700">"{{ $query }}"</span>
        </h2>

        <div id="productGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <a href="{{ route('view', ['id' => $product->id]) }}" class="block">
                    <div class="bg-white rounded-lg shadow hover:shadow-md transition p-8 space-y-1 hover:ring-2 hover:ring-[#BD806B]">
                        <img src="{{ $product->thumb_images_url }}"
                             alt="{{ $product->title }}"
                             class="w-full h-48 object-cover rounded-md hover:opacity-90 transition">

                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                        <p class="text-sm text-gray-500">{{ Str::limit($product->description, 60) }}</p>

                        <div class="flex justify-between items-center">
                            <span class="text-[#BD806B] font-bold text-lg">Rs. {{ $product->price }}</span>
                            <span class="text-xs text-gray-600">Stock: {{ $product->stock }}</span>
                        </div>

                        <div class="text-sm text-gray-600">Color: {{ $product->color }}</div>
                    </div>
                </a>
            @endforeach
        </div>
@endsection
