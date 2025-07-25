@extends('template')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Breadcrumbs -->
        <div class="text-sm text-gray-600 mb-4">
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4">
                <form method="GET" action="{{ route('collection') }}" class="space-y-6">
                    <!-- Category Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center justify-between">
                            <span>Category</span>
                            <span class="text-gray-500">▼</span>
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('collection') }}"
                               class="block px-3 py-2 rounded text-sm transition
                           {{ !request('category') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                All Categories
                            </a>
                            @foreach($categories as $category)
                                <button name="category" value="{{ $category->id }}"
                                        class="block w-full text-left px-3 py-2 rounded text-sm transition
                                {{ request('category') == $category->id ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                    {{ $category->title }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Badge Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center justify-between">
                            <span>Label</span>
                            <span class="text-gray-500">▼</span>
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('collection') }}"
                               class="block px-3 py-2 rounded text-sm transition
                           {{ !request('badge') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                All Labels
                            </a>
                            @foreach($badges as $badge)
                                <button name="badge" value="{{ $badge->id }}"
                                        class="block w-full text-left px-3 py-2 rounded text-sm transition
                                {{ request('badge') == $badge->id ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                    {{ $badge->title }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center justify-between">
                            <span>Color</span>
                            <span class="text-gray-500">▼</span>
                        </h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['Blue', 'Grey', 'Red', 'Yellow'] as $color)
                                <button name="color" value="{{ strtolower($color) }}"
                                        class="flex items-center px-3 py-2 rounded text-sm transition
                                {{ request('color') == strtolower($color) ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ strtolower($color) }}"></span>
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center justify-between">
                            <span>Price</span>
                            <span class="text-gray-500">▼</span>
                        </h3>
                        <div class="grid grid-cols-3 gap-2">
                            <button name="price_range" value="cheap"
                                    class="px-3 py-2 rounded text-sm transition
                                {{ request('price_range') == 'cheap' ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                Cheap
                            </button>
                            <button name="price_range" value="mid"
                                    class="px-3 py-2 rounded text-sm transition
                                {{ request('price_range') == 'mid' ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                Mid
                            </button>
                            <button name="price_range" value="expensive"
                                    class="px-3 py-2 rounded text-sm transition
                                {{ request('price_range') == 'expensive' ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                Expensive
                            </button>
                        </div>
                    </div>

                    <!-- Size Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="font-medium text-gray-900 mb-3 flex items-center justify-between">
                            <span>Size</span>
                            <span class="text-gray-500">▼</span>
                        </h3>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach(['S', 'M', 'L', 'XL'] as $size)
                                <button name="size" value="{{ $size }}"
                                        class="px-3 py-2 rounded text-sm transition text-center
                                {{ request('size') == $size ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="lg:w-3/4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <a href="{{ route('view', ['id' => $product->id]) }}" class="group">
                            <div class="bg-white rounded-lg shadow hover:shadow-md transition-all h-full flex flex-col">
                                <!-- Product Image -->
                                <div class="relative">
                                    <img src="{{ $product->thumb_images_url }}"
                                         alt="{{ $product->title }}"
                                         class="w-full h-48 object-cover rounded-t-lg group-hover:opacity-90 transition">
                                    @if($product->badge)
                                        <span class="absolute top-2 right-2 bg-[#BD806B] text-white text-xs font-medium px-2 py-1 rounded">
                                {{ $product->badge->title }}
                            </span>
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
