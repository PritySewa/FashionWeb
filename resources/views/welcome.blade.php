@extends('template')
@section('content')
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display&display=swap" rel="stylesheet">
        <style>
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

        </style>
    </head>
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row w-full bg-white bg-opacity-20 backdrop-blur-md rounded-xl ">
        <!-- Left: Image -->
        <div class="w-full md:w-1/2 lg:w-2/5 pt-8 md:pt-3 overflow-hidden" style="max-height: 700px;">
            @if(Str::startsWith($home->image, ['http://', 'https://']))
                <img src="{{ $home->image }}" class="w-full object-cover scale-105 shadow-2xl" style="object-position: top;" />
            @else
                <img src="{{ asset('storage/' . $home->image) }}" class="w-full object-cover shadow-lg" style="object-position: top;" />
            @endif
        </div>


        <!-- Right: Content -->
        <div class="w-full md:w-1/2 lg:w-3/5 p-8 md:p-12 flex flex-col justify-center" style="background-color: #EFDECD;">
            <!-- Tagline -->
            <div class="bg-[#A9746E] bg-opacity-20 inline-block w-fit px-3 py-1  mb-4 rounded-lg ">
                <span class="text-l font-medium tracking-widest text-[#8B4513] uppercase">ONLINE SHOPPING IN NEPAL</span>
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6 text-gray-900 italic text-shadow">
                Shop Now!!
            </h1>

            <!-- Description -->
            <div class="mb-8">
                <div class="bg-[#A9746E] bg-opacity-10 border border-[#A9746E] shadow-lg rounded-lg p-6">
                    <p class="text-gray-700 text-1xl leading-relaxed">
                        {{ $home->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>


    <!-- Category Navigation -->
    <!-- Category Navigation with Images -->
    <div class="mb-16">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Shop by Category</h2>
            <a href="{{ route('collection') }}" class="text-sm font-medium text-[#BD806B] hover:text-[#a36d5a] transition flex items-center">
                View all <span class="ml-1">→</span>
            </a>
        </div>

        <form method="GET" action="{{ route('collection') }}" id="categoryFilterForm">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <!-- All Categories Button -->
{{--                <button type="submit" name="category" value=""--}}
{{--                        class="group relative block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition h-40--}}
{{--                    {{ !request('category') ? 'ring-2 ring-[#BD806B]' : '' }}">--}}
{{--                    <div class="absolute inset-0 bg-gradient-to-br from-[#BD806B] to-[#a36d5a] flex items-center justify-center">--}}
{{--                        <div class="text-center p-4">--}}
{{--                            <span class="text-white text-lg font-bold block">All</span>--}}
{{--                            <span class="text-white text-opacity-80 text-sm">Categories</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </button>--}}

                <!-- Category Buttons with Images -->
                @foreach($categories as $category)
                    <button type="submit"
                            name="category"
                            value="{{ $category->id }}"
                            class="group relative block rounded-xl overflow-hidden shadow-sm hover:shadow-md transition h-40
                        {{ request('category') == $category->id ? 'ring-2 ring-[#BD806B]' : '' }}">
                        @if($category->images)
                            @if(Str::startsWith($category->images, ['http://', 'https://']))
                                <img src="{{ $category->images }}" alt="{{ $category->title }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $category->images) }}" alt="{{ $category->title }}" class="absolute inset-0 w-full h-full object-cover">
                            @endif
                        @else
                            <div class="absolute inset-0 bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-30 group-hover:bg-opacity-20 transition"></div>
                        <div class="absolute inset-0 flex items-end p-4">
                            <span class="text-white font-bold text-shadow">{{ $category->title }}</span>
                        </div>
                    </button>
                @endforeach

                <!-- Hidden inputs to preserve other query parameters -->
                @foreach(request()->except('category', '_token') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
            </div>
        </form>
    </div>



    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Products</h2>

            <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products->take(8) as $product)
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
                                 class="w-full h-48 object-cover rounded-md transition">

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
    </section>


{{--  --}}


@endsection

