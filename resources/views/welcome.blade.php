@extends('template')
@section('content')
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row w-full bg-white bg-opacity-20 backdrop-blur-md rounded-xl ">
        <!-- Left: Image -->
        <div class="w-full md:w-1/2 lg:w-2/5">
            @if(Str::startsWith($home->image, ['http://', 'https://']))
                <img src="{{ $home->image }}" class="w-full h-4/5 object-cover max-h-screen" style="min-height: 400px;">
            @else
                <img src="{{ asset('storage/' . $home->image) }}" class="w-full h-4/5 object-cover max-h-screen" style="min-height: 400px;">
            @endif
        </div>

        <!-- Right: Content -->
        <div class="w-full md:w-1/2 lg:w-3/5 p-8 md:p-12 flex flex-col justify-center">
            <!-- Tagline -->
            <div class="bg-[#cda991] bg-opacity-20 inline-block px-3 py-1 rounded mb-4">
                <span class="text-l font-medium tracking-widest text-[#cda991] uppercase">ONLINE SHOPPING IN NEPAL</span>
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6 text-gray-900 italic">Shop Now!!</h1>

            <!-- Description -->
            <div class="mb-8">
                <div class="bg-[#cda991] bg-opacity-10 p-6 rounded-lg border-l-4 border-[#cda991]">
                    <p class="text-gray-700 text-1xl leading-relaxed">
                        {{ $home->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

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
