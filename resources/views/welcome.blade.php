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


    <!-- Featured Collections Section -->
{{--    <div class="mt-0 px-4 md:px-0">--}}
{{--        <div class="bg-white bg-opacity-20 backdrop-blur-md rounded-xl p-6">--}}
{{--            <!-- Heading -->--}}
{{--            <div class="mb-2">--}}
{{--                <h2 class="text-2xl font-bold text-gray-800">Featured Collections</h2>--}}
{{--            </div>--}}

{{--            <!-- Horizontal Scroll Wrapper - Removed all gaps -->--}}
{{--            <div class="flex overflow-x-auto scrollbar-hide -mx-[1px]">--}}
{{--                @foreach($categories as $category)--}}
{{--                    <div class="flex-shrink-0 relative">--}}
{{--                        <!-- Image Container - Maintained original size -->--}}
{{--                        <div class="h-60 w-[250px] overflow-hidden border-r border-transparent">--}}
{{--                            @if ($category->images)--}}
{{--                                @if(Str::startsWith($category->images, ['http://', 'https://']))--}}
{{--                                    <img src="{{ $category->images }}" alt="{{ $category->title }}" class="w-full h-full object-cover">--}}
{{--                                @else--}}
{{--                                    <img src="{{ asset('storage/' . $category->images) }}" alt="{{ $category->title }}" class="w-full h-full object-cover">--}}
{{--                                @endif--}}
{{--                            @else--}}
{{--                                <div class="flex items-center justify-center h-full w-[250px] text-gray-400 bg-gray-100">No Image</div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <!-- Title -->--}}
{{--                        <h3 class="text-lg font-semibold text-center text-gray-800 mt-2">{{ $category->title }}</h3>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
            {{--            <!-- Simple CTA Button -->--}}
{{--            <button class="self-start bg-[#cda991] text-white px-8 py-3 rounded hover:bg-opacity-90 transition">--}}
{{--                Shop Now--}}
{{--            </button>--}}

            <!-- Footer note - subtle -->

{{--    <!-- Ensure the image scales properly -->--}}
{{--            <img src="{{ asset('images/welcome.png') }}" class="w-full h-auto rounded-xl object-cover">--}}
{{--        </div>--}}

{{--        <!-- Product Grid -->--}}
{{--        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-16">--}}
{{--            @foreach($products as $product)--}}
{{--                <div class="bg-white border rounded-xl shadow-md p-6 transition-transform transform hover:scale-105 hover:shadow-xl">--}}

{{--                    <!-- Product Image -->--}}
{{--                    <a href="{{ route('view', $product->id) }}" class="block">--}}
{{--                        <img src="{{  $product->thumb_images_url }}"--}}
{{--                             class="w-full h-60 sm:h-72 object-cover rounded-lg transition-opacity duration-300 hover:opacity-85">--}}
{{--                    </a>--}}

{{--                    <!-- Product Details -->--}}
{{--                    <div class="mt-5 text-center">--}}
{{--                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->title }}</h2>--}}
{{--                        <p class="text-lg font-medium text-indigo-600 mt-2">--}}
{{--                            ${{ $product->price }}--}}
{{--                        </p>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--    </div>--}}
@endsection
