@extends('template')

@section('content')
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display&display=swap" rel="stylesheet">
        <style>
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }
             summary {
                 cursor: pointer;
             }
        </style>
    </head>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Breadcrumbs -->

        <div class="flex flex-col lg:flex-row gap-1">
            <!-- Filters Sidebar -->
            <div class="w-full lg:w-1/4">
                <div class=" sticky top-24 mr-10 max-h-[calc(100vh-6rem)] overflow-y-auto pr-2">

                    <!-- Filters Container -->
                    <div class=" bg-[#fdf6f0] border border-black p-4 rounded-lg shadow-md space-y-6">
                        <h1 class="text-1xl text-center md:text-2xl font-serif font-bold mb-6 text-gray-900 text-shadow">
                            Filters
                        </h1>

                        <form method="GET" action="{{ route('collection') }}" class="space-y-6">
                            <!-- Category Filter -->
                            <details class="bg-[#EFDECD] p-4 rounded-lg shadow-sm" {{ request('category') ? 'open' : '' }}>
                                <summary class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Category</summary>
                                <div class="mt-2 space-y-2">
                                    <a href="{{ route('collection') }}"
                                       class="block px-3 py-2 rounded text-sm transition
                               {{ !request('category') ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                        All Categories
                                    </a>
                                    @foreach($categories as $category)
                                        <button type="submit" name="category" value="{{ $category->id }}"
                                                class="block w-full text-left px-3 py-2 rounded text-sm transition
                                        {{ request('category') == $category->id ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                            {{ $category->title }}
                                        </button>
                                    @endforeach
                                </div>
                            </details>

                            <!-- Badge Filter -->
                            <details class="bg-[#EFDECD] p-4 rounded-lg shadow-sm" {{ request('badge') ? 'open' : '' }}>
                                <summary class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Badge</summary>
                                <div class="mt-2 space-y-2">
                                    <a href="{{ route('collection') }}"
                                       class="block px-3 py-2 rounded text-sm transition
                               {{ !request('badge') ? 'bg-[#fdf6f0] text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                        All Badges
                                    </a>
                                    @foreach($badges as $badge)
                                        <button name="badge" value="{{ $badge->id }}"
                                                class="block w-full text-left px-3 py-2 rounded text-sm transition
                                        {{ request('badge') == $badge->id ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                            {{ $badge->title }}
                                        </button>
                                    @endforeach
                                </div>
                            </details>

                            <!-- Color Filter -->
                            <details class="bg-[#EFDECD] p-4 rounded-lg shadow-sm" {{ request('color') ? 'open' : '' }}>
                                <summary class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Color</summary>
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    @foreach(['Blue', 'Grey', 'Red', 'Yellow'] as $color)
                                        <button name="color" value="{{ strtolower($color) }}"
                                                class="flex items-center px-3 py-2 rounded text-sm transition
                                        {{ request('color') == strtolower($color) ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ strtolower($color) }}"></span>
                                            {{ $color }}
                                        </button>
                                    @endforeach
                                </div>
                            </details>

                            <!-- Price Filter -->
                            <details class="bg-[#EFDECD] p-4 rounded-lg shadow-sm" {{ request('price_range') ? 'open' : '' }}>
                                <summary class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Price</summary>
                                <div class="grid grid-cols-3 gap-2 mt-2">
                                    @foreach(['cheap', 'mid', 'expensive'] as $range)
                                        <button name="price_range" value="{{ $range }}"
                                                class="px-0 py-2 rounded text-sm transition
                                        {{ request('price_range') == $range ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                            {{ ucfirst($range) }}
                                        </button>
                                    @endforeach
                                </div>
                            </details>

                            <!-- Size Filter -->
                            <details class="bg-[#EFDECD] p-4 rounded-lg shadow-sm" {{ request('size') ? 'open' : '' }}>
                                <summary class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Size</summary>
                                <div class="grid grid-cols-4 gap-2 mt-2">
                                    @foreach(['S', 'M', 'L', 'XL'] as $size)
                                        <button name="size" value="{{ $size }}"
                                                class="px-3 py-2 rounded text-sm transition
                                        {{ request('size') == $size ? 'bg-[#fdf6f0]  text-black font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                            {{ $size }}
                                        </button>
                                    @endforeach
                                </div>
                            </details>
                        </form>
                    </div>
                </div>
            </div>




            <!-- Products Grid -->
            <div class="lg:w-3/4">
                <div class=" w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                    @forelse($products as $product)
                        <a href="{{ route('view', ['id' => $product->id]) }}" class="group">
                            <div class="bg-[#fdf6f0] border border-[#A9746E] rounded-lg shadow hover:shadow-md transition-all h-full flex flex-col hover:ring-2 hover:ring-[#BD806B]">
                                <!-- Product Image -->
                                <div class="relative p-4">
                                    <img src="{{ $product->thumb_images_url }}"
                                         alt="{{ $product->title }}"
                                         class="w-full h-48 object-contain scale-105 rounded-t-lg group-hover:opacity-90 transition">
                                    @if(!empty($product->badge) && !empty($product->badge->icon_path))
                                        <img
                                            src="{{ $product->badge->icon_path }}"
                                            alt="Badge"
                                            class="absolute top-2 left-2 w-8 h-8 object-contain bg-white rounded-full p-1 shadow"
                                        />
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="p-4 flex-grow">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $product->title }}</h3>
                                    <p class="text-sm text-gray-500 mb-3">{{ Str::limit($product->description, 60) }}</p>

                                    <div class="mt-auto">
                                        <div class="flex justify-between items-center">
                                            <span class="text-[#BD806B] font-bold">Rs. {{ number_format($product->price, 2) }}</span>
                                            <span class="text-xs text-gray-500">{{ $product->stock }} in stock</span>
                                        </div>
                                        <div class="mt-2 text-xs text-gray-500">
                                            Color: {{ $product->color }} | Size: {{ $product->size }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No products found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your filters</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
