@extends('template') {{-- or your layout file --}}
@section('content')

    <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6"> <span class="text-blue-600">{{ $query }}</span></h2>

        @if($products->count())
           <div class="aspect-[3/4] max-w-[200px] bg-white rounded shadow overflow-hidden">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                        <img src="{{($product->thumb_images_url) }}"
                             alt="{{ $product->title }}"
                             class="w-auto h-40 object-contain bg-gray-100 rounded-md" />
                        <div class="p-4">
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-3 text-green-600 font-bold text-sm">Rs. {{ $product->price }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center mt-10">No products found for "<strong>{{ $query }}</strong>".</p>
        @endif
    </div>
@endsection
