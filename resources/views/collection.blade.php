@extends('template')

@section('content')

    <div class="max-w-7xl mx-auto px-4 py-6">
        <form method="GET" action="{{ route('collection') }}">
            <div class="flex flex-col gap-6">

                {{-- Category Filter --}}
                <div>
                    <div class="text-black text-sm font-medium mb-2">Category:</div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('collection') }}"
                           class="px-4 py-1 rounded-full text-sm border transition
                   {{ request('category') ? 'border-gray-300 text-gray-500' : 'border-blue-500 text-blue-600 font-semibold bg-blue-100' }}">
                            All
                        </a>

                        @foreach($categories as $category)
                            <button name="category" value="{{ $category->id }}"
                                    class="px-4 py-1 rounded-full text-sm border transition
                            {{ request('category') == $category->id
                                ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                                : 'border-gray-300 text-gray-500' }}">
                                {{ $category->title }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="text-black text-sm font-medium mb-2">Badges:</div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('collection') }}"
                           class="px-4 py-1 rounded-full text-sm border transition
                   {{ request('badge') ? 'border-gray-300 text-gray-500' : 'border-blue-500 text-blue-600 font-semibold bg-blue-100' }}">
                            All
                        </a>

                        @foreach($badges as $badge)
                            <button name="Badge" value="{{ $badge->id }}"
                                    class="px-4 py-1 rounded-full text-sm border transition
                            {{ request('badge') == $badge->id
                                ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                                : 'border-gray-300 text-gray-500' }}">
                                {{ $badge->title }}
                            </button>
                        @endforeach
                    </div>
                </div>
                {{-- Price Filter --}}
                <div>
                    <div class="text-black text-sm font-medium mb-2">Price Range:</div>
                    <div class="flex flex-wrap gap-3">
                        <button name="price_range" value="cheap"
                                class="px-4 py-1 rounded-full text-sm border transition
            {{ request('price_range') == 'cheap'
                ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                : 'border-gray-300 text-gray-500' }}">
                            Cheap
                        </button>

                        <button name="price_range" value="mid"
                                class="px-4 py-1 rounded-full text-sm border transition
            {{ request('price_range') == 'mid'
                ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                : 'border-gray-300 text-gray-500' }}">
                            Mid
                        </button>

                        <button name="price_range" value="expensive"
                                class="px-4 py-1 rounded-full text-sm border transition
            {{ request('price_range') == 'expensive'
                ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                : 'border-gray-300 text-gray-500' }}">
                            Expensive
                        </button>
                    </div>
                </div>
                {{-- Size Filter --}}
                <div>
                    <div class="text-black text-sm font-medium mb-2">Size:</div>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['S', 'M', 'L', 'XL'] as $size)
                            <button name="size" value="{{ $size }}"
                                    class="px-4 py-1 rounded-full text-sm border transition
                {{ request('size') == $size
                    ? 'border-blue-500 text-blue-600 font-semibold bg-blue-100'
                    : 'border-gray-300 text-gray-500' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <a href="{{ route('view', ['id' => $product->id]) }}" class="block relative">

                            <div class="bg-white rounded-lg shadow hover:shadow-md transition p-4 space-y-2 hover:ring-2 hover:ring-[#BD806B] relative">

                                {{-- Badge --}}
                                @if(!empty($product->badge) && !empty($product->badge->icon_path))
                                    <img
                                        src="{{ $product->badge->icon_path }}"
                                        alt="Badge"
                                        class="absolute top-2 left-2 w-8 h-8 object-contain bg-white rounded-full p-1 shadow"
                                    />
                                @endif


                                <img src="{{ $product->thumb_images_url }}" alt="{{ $product->title }}"
                                     class="w-full h-48 object-cover rounded-md  transition">

                                <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                                <p class="text-sm text-gray-500">{{ Str::limit($product->description, 60) }}</p>

                                <div class="flex justify-between items-center">
                                    <span class="text-[#BD806B] font-bold text-lg">Rs. {{ $product->price }}</span>
                                    <span class="text-xs text-gray-600">Stock: {{ $product->stock }}</span>
                                </div>

                                <div class="text-sm text-gray-600">Color: {{ $product->color }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-4 text-center text-gray-500">
                            No products found in this category.
                        </div>
                    @endforelse
                </div>
    </div>

@endsection
