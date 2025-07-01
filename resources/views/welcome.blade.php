@extends('template')
@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        <!-- Hero Section -->
        <div class="relative w-full rounded-xl shadow-lg overflow-hidden flex justify-center items-center">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-40"></div>



            <!-- Ensure the image scales properly -->
            <img src="{{ asset('images/welcome.png') }}" class="w-full h-auto rounded-xl object-cover">
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-16">
            @foreach($products as $product)
                <div class="bg-white border rounded-xl shadow-md p-6 transition-transform transform hover:scale-105 hover:shadow-xl">

                    <!-- Product Image -->
                    <a href="{{ route('view', $product->id) }}" class="block">
                        <img src="{{  $product->thumb_images_url }}"
                             class="w-full h-60 sm:h-72 object-cover rounded-lg transition-opacity duration-300 hover:opacity-85">
                    </a>

                    <!-- Product Details -->
                    <div class="mt-5 text-center">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $product->title }}</h2>
                        <p class="text-lg font-medium text-indigo-600 mt-2">
                            ${{ $product->price }}
                        </p>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
@endsection
