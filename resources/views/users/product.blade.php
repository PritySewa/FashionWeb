{{--@extends('template')--}}
{{--@section('content')--}}


{{--    <div class="relative w-full max-w-xl mx-auto">--}}
{{--        <!-- Image Container -->--}}
{{--        <div id="carouselImages" class="overflow-hidden rounded-lg shadow-md h-96 relative">--}}
{{--            <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out">--}}
{{--                @foreach ($products->image_urls as $image)--}}
{{--                    <img src="{{ Str::startsWith($image, ['http://', 'https://']) ? $image : asset('storage/' . $image) }}"--}}
{{--                         class="w-full flex-shrink-0 object-cover h-96"--}}
{{--                         alt="{{ $products->title }}">--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Navigation Buttons -->--}}
{{--        <button onclick="slideCarousel(-1)"--}}
{{--                class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-[#BD806B] bg-opacity-80 hover:bg-opacity-100 text-white px-3 py-2 rounded-r z-10">--}}
{{--            &#10094;--}}
{{--        </button>--}}
{{--        <button onclick="slideCarousel(1)"--}}
{{--                class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-[#BD806B] bg-opacity-80 hover:bg-opacity-100 text-white px-3 py-2 rounded-l z-10">--}}
{{--            &#10095;--}}
{{--        </button>--}}
{{--    </div>--}}


{{--    <!-- Product Details -->--}}
{{--            <div class="space-y-6">--}}
{{--                <h1 class="text-3xl font-bold text-gray-900">{{ $products->title }}</h1>--}}
{{--                <p class="text-2xl text-[#BD806B] font-semibold">Rs. {{ $products->price }}</p>--}}
{{--                <p class="text-sm text-gray-600">Stock: {{ $products->stock }}</p>--}}
{{--                <p class="text-sm text-gray-600">Color: {{ $products->color }}</p>--}}
{{--                <p class="text-sm text-gray-600">{{ $products->description}}</p>--}}




{{--                <!-- Quantity Input -->--}}
{{--                <div>--}}
{{--                    <label for="quantity" class="block text-sm font-medium mb-1">Quantity</label>--}}
{{--                    <input type="number" id="quantity" value="1" min="1" max="{{ $products->stock }}"--}}
{{--                           class="w-24 border border-gray-400 rounded-md p-2 text-lg text-center font-medium focus:ring-2 focus:ring-[#BD806B] focus:border-[#BD806B]"--}}
{{--                           oninput="calculateTotal()">--}}
{{--                </div>--}}

{{--                <!-- Total Price -->--}}
{{--                <p class="text-lg font-semibold text-green-700">Total: Rs. <span id="total">{{ $products->price }}</span></p>--}}

{{--                <!-- Action Buttons -->--}}
{{--                <div class="flex space-x-4 mt-4">--}}
{{--                    <form method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="product_id" value="{{ $products->id }}">--}}
{{--                        <input type="hidden" name="quantity" id="formQuantity" value="1">--}}
{{--                        <input type="hidden" name="color" id="formColor" value="">--}}
{{--                        <button type="submit"--}}
{{--                                class="bg-[#BD806B] hover:bg-[#C4957A] text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition">--}}
{{--                            Add to Cart--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                    <form method="GET" action="{{ route('buy.now') }}">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="product_id" value="{{ $products->id }}">--}}
{{--                        <input type="hidden" name="quantity" id="hidden-quantity">--}}
{{--                        <button type="submit"--}}
{{--                                class="bg-[#77665E] hover:bg-[#8A776E] text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition">--}}
{{--                            Buy Now--}}
{{--                        </button>--}}
{{--                    </form>--}}







{{--    <script>--}}
{{--        let currentSlide = 0;--}}
{{--        function slideCarousel(direction) {--}}
{{--            const track = document.getElementById('carouselTrack');--}}
{{--            const images = track.querySelectorAll('img');--}}
{{--            const totalSlides = images.length;--}}

{{--            currentSlide += direction;--}}

{{--            // Loop back if needed--}}
{{--            if (currentSlide < 0) currentSlide = totalSlides - 1;--}}
{{--            if (currentSlide >= totalSlides) currentSlide = 0;--}}

{{--            const slideWidth = images[0].clientWidth;--}}
{{--            track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;--}}
{{--        }--}}
{{--    </script>--}}



{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        const price = {{ $products->price }};--}}

{{--        $(document).on('change', '#quantity', function () {--}}
{{--            let value = this.value;--}}
{{--            document.getElementById('hidden-quantity').value = value;--}}
{{--        });--}}

{{--        function calculateTotal() {--}}
{{--            const qty = document.getElementById('quantity').value;--}}
{{--            document.getElementById('total').innerText = (qty * price).toFixed(2);--}}
{{--        }--}}

{{--        function syncFormInputs() {--}}
{{--            document.getElementById('formQuantity').value = document.getElementById('quantity').value;--}}
{{--            document.getElementById('formColor').value = document.getElementById('color').value;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}


@extends('template')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Product Card Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Product Content -->
            <div class="flex flex-col md:flex-row gap-12 p-6">
                <!-- Image Carousel -->
                <div class="w-full md:w-1/2">
                    <div class="relative overflow-hidden rounded-xl shadow-lg bg-gray-50">
                        <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out h-96">
                            @foreach ($images as $image)
                                <img src="{{ Str::startsWith($image, ['http://', 'https://']) ? $image : asset('storage/' . $image) }}"
                                     class="w-full flex-shrink-0 object-contain h-96 p-4"
                                     alt="{{ $product->title }}">
                            @endforeach
                        </div>

                        <button onclick="slideCarousel(-1)"
                                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 transition">
                            &#10094;
                        </button>
                        <button onclick="slideCarousel(1)"
                                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 transition">
                            &#10095;
                        </button>

                        <!-- Slide Indicators -->
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            @foreach ($images as $index => $image)
                                <span onclick="goToSlide({{ $index }})"
                                      class="w-3 h-3 rounded-full cursor-pointer transition {{ $index === 0 ? 'bg-[#BD806B]' : 'bg-gray-300' }} slide-indicator"></span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2">
                    <div class="space-y-6">
                        <!-- Title and Price -->
                        <div class="border-b border-gray-200 pb-4">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                            <p class="text-2xl text-[#BD806B] font-semibold mt-2">Rs. {{ number_format($product->price, 2) }}</p>
                        </div>

                        <!-- Stock and Color -->
                        <div class="flex gap-8 text-sm">
                            <div>
                                <span class="text-gray-500">Availability:</span>
                                <span class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Color:</span>
                                <span class="font-medium">{{ $product->color }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>

                        <!-- Quantity Selector -->
                        <div class="pt-2">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <div class="flex items-center">
{{--                                <button onclick="adjustQuantity(-1)" class="bg-gray-200 hover:bg-gray-300 h-10 w-10 rounded-l-lg flex items-center justify-center transition">--}}
{{--                                    −--}}
{{--                                </button>--}}
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                       class="h-10 w-20 border-t border-b border-gray-300 text-center font-medium focus:ring-1 focus:ring-[#BD806B]">
{{--                                <button onclick="adjustQuantity(1)" class="bg-gray-200 hover:bg-gray-300 h-10 w-10 rounded-r-lg flex items-center justify-center transition">--}}
{{--                                    +--}}
{{--                                </button>--}}
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-lg font-semibold text-gray-800">Total:
                                <span class="text-2xl text-[#BD806B] ml-2">Rs. <span id="total">{{ number_format($product->price, 2) }}</span></span>
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            <form method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="formQuantity" value="1">
                                <input type="hidden" name="color" id="formColor" value="">
                                <button type="submit"
                                        class="w-full bg-[#BD806B] hover:bg-[#a86d59] text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to Cart
                                </button>
                            </form>

                            <form method="GET" action="{{ route('buy.now') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                                <button type="submit"
                                        class="w-full bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium text-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Buy Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View All Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('collection') }}" class="inline-block text-lg font-medium text-[#BD806B] hover:text-[#a36d5a] transition flex items-center justify-center group">
                View all
                <span class="ml-2 transform group-hover:translate-x-1 transition-transform duration-200">→</span>
            </a>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const price = {{ $product->price }};

        function slideCarousel(direction) {
            const track = document.getElementById('carouselTrack');
            const images = track.querySelectorAll('img');
            const totalSlides = images.length;
            const indicators = document.querySelectorAll('.slide-indicator');

            currentSlide += direction;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            if (currentSlide >= totalSlides) currentSlide = 0;

            updateCarousel(track, images, indicators);
        }

        function goToSlide(index) {
            const track = document.getElementById('carouselTrack');
            const images = track.querySelectorAll('img');
            const indicators = document.querySelectorAll('.slide-indicator');

            currentSlide = index;
            updateCarousel(track, images, indicators);
        }

        function updateCarousel(track, images, indicators) {
            const slideWidth = images[0].clientWidth;
            track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-[#BD806B]', index === currentSlide);
                indicator.classList.toggle('bg-gray-300', index !== currentSlide);
            });
        }

        function adjustQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let newValue = parseInt(quantityInput.value) + change;
            newValue = Math.max(1, Math.min(newValue, {{ $product->stock }}));
            quantityInput.value = newValue;
            calculateTotal();
        }

        function calculateTotal() {
            const quantity = document.getElementById('quantity').value;
            document.getElementById('total').innerText = (quantity * price).toFixed(2);
            document.getElementById('hidden-quantity').value = quantity;
        }

        function syncFormInputs() {
            document.getElementById('formQuantity').value = document.getElementById('quantity').value;
        }

        // Initialize quantity input event listener
        document.getElementById('quantity').addEventListener('input', calculateTotal);
    </script>

    <style>
        .slide-indicator {
            transition: background-color 0.3s ease;
        }
        #carouselTrack img {
            object-fit: contain;
            background-color: #f9fafb;
        }
    </style>
@endsection
