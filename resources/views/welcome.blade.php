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
            <div class="bg-[#A9746E] bg-opacity-20 inline-block w-fit mt-12 px-3 py-1  mb-4 rounded-lg ">
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

            {{--    CategoryGrid--}}
            <section class="py-8 px-1">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center -mt-6 mb-4">
                        <div class="bg-[#A9746E] bg-opacity-20 inline-block px-3 py-1 rounded-lg w-fit">
                            <span class="text-l font-medium tracking-widest text-[#8B4513] uppercase">Our Categories</span>
                        </div>
                    </div>
                    <a href="{{ route('collection') }}" class="text-m font-medium text-[#BD806B] hover:text-[#a36d5a] transition flex items-center">
                        View all <span class="ml-1">→</span>
                    </a>
                    <form method="GET" action="{{ route('collection') }}" id="categoryFilterForm">
                        <div id="categoryGrid" class="grid grid-cols-5 gap-2">

                            @foreach($categories as $category)
                                <button type="submit"
                                        name="category"
                                        value="{{ $category->id }}"
                                        class="group relative block rounded-xl overflow-hidden transition h-40 {{ request('category') == $category->id ? 'ring-2 ring-[#BD806B]' : '' }}">
                                    @if(Str::startsWith($category->images, ['http://', 'https://']))
                                        <img src="{{ $category->images }}" alt="{{ $category->title }}" class="absolute inset-0 w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset($category->images) }}" alt="{{ $category->title }}" class="absolute inset-0 w-full h-full object-cover">
                                    @endif

                                        <div class="absolute border border-black inset-0 transition group-hover:opacity-20" style="background-color: rgba(169, 116, 110, 0.3);"></div>
                                    <div class="absolute inset-0 flex items-end p-4">
                                        <span class="text-white font-extrabold text-lg [text-shadow:_-1px_-1px_0_#000,_1px_-1px_0_#000,_-1px_1px_0_#000,_1px_1px_0_#000]">
                                            {{ $category->title }}
                                        </span>

                                    </div>
                                </button>
                            @endforeach

                            @foreach(request()->except('category', '_token') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                        </div>
                    </form>

                </div>
        </section>
        </div>
    </div>


{{--    ProductGrid--}}
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center -mt-2 mb-4">
                <div class="bg-[#A9746E] bg-opacity-20 inline-block px-3 py-1 rounded-lg w-fit">
                    <span class="text-xl font-medium tracking-widest text-[#8B4513] uppercase">Our Products</span>
                </div>
            </div>
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

@endsection

