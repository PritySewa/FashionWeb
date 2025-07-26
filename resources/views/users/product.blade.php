@extends('template')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Product Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Image Carousel -->
                <div class="w-full md:w-1/2 p-4">
                    <div class="relative overflow-hidden rounded-lg bg-gray-50 h-80 md:h-96">
                        <div id="carouselTrack" class="flex transition-transform duration-300 ease-in-out h-full">
                            @if(is_array($product->image_urls))
                                @foreach($product->image_urls as $url)
                                    <img src="{{ $url }}" alt="{{ $product->title }}"
                                         class="w-full flex-shrink-0 object-contain h-full p-4">
                                @endforeach
                            @endif
                        </div>

                        <!-- Navigation Buttons -->
                        <button onclick="slideCarousel(-1)"
                                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow-sm z-10 transition">
                            &#10094;
                        </button>
                        <button onclick="slideCarousel(1)"
                                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-8 h-8 rounded-full flex items-center justify-center shadow-sm z-10 transition">
                            &#10095;
                        </button>

                        <!-- Slide Indicators -->
                        <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1">
                            @if(is_array($product->image_urls))
                                @foreach ($product->image_urls as $index => $image)
                                    <span onclick="goToSlide({{ $index }})"
                                          class="w-2 h-2 rounded-full cursor-pointer transition {{ $index === 0 ? 'bg-[#BD806B]' : 'bg-gray-300' }}"></span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 p-6">
                    <div class="space-y-4">
                        <h1 class="text-2xl font-medium text-gray-900">{{ $product->title }}</h1>

                        <div class="flex items-center justify-between">
                            <p class="text-xl text-[#BD806B] font-medium">Rs. {{ number_format($product->price, 2) }}</p>
                            <span class="text-sm px-2 py-1 rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <p>Color: {{ $product->color }}</p>
                        </div>

                        <div class="border-t border-gray-100 pt-3">
                            <p class="text-gray-700 text-sm">{{ $product->description }}</p>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="pt-3">
                            <label class="block text-sm text-gray-600 mb-1">Quantity</label>
                            <div class="flex items-center">
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                       class="w-20 border border-gray-200 rounded-md px-3 py-2 text-center focus:ring-1 focus:ring-[#BD806B] focus:border-[#BD806B]">
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="bg-gray-50 p-3 rounded-lg mt-3">
                            <p class="text-gray-800 flex justify-between items-center">
                                <span>Total:</span>
                                <span class="text-lg text-[#BD806B] font-medium" id="total">{{ number_format($product->price, 2) }}</span>
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-3">
                            <form method="POST" action="{{ route('cart.store') }}" onsubmit="syncFormInputs()" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="formQuantity" value="1">
                                <input type="hidden" name="color" id="formColor" value="">
                                <button type="submit"
                                        class="w-full bg-[#BD806B] hover:bg-[#a86d59] text-white px-4 py-2 rounded-md font-medium transition flex items-center justify-center gap-2">
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
                                        class="w-full bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition flex items-center justify-center gap-2">
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

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('collection') }}" class="inline-flex items-center text-sm text-[#BD806B] hover:text-[#a36d5a] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Collection
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

            currentSlide += direction;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            if (currentSlide >= totalSlides) currentSlide = 0;

            updateCarousel(track, images);
        }

        function goToSlide(index) {
            const track = document.getElementById('carouselTrack');
            const images = track.querySelectorAll('img');
            currentSlide = index;
            updateCarousel(track, images);
        }

        function updateCarousel(track, images) {
            const slideWidth = images[0].clientWidth;
            track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

            // Update indicators
            document.querySelectorAll('.slide-indicator').forEach((indicator, i) => {
                indicator.classList.toggle('bg-[#BD806B]', i === currentSlide);
                indicator.classList.toggle('bg-gray-300', i !== currentSlide);
            });
        }

        function calculateTotal() {
            const quantity = document.getElementById('quantity').value;
            document.getElementById('total').innerText = (quantity * price).toFixed(2);
            document.getElementById('hidden-quantity').value = quantity;
        }

        function syncFormInputs() {
            document.getElementById('formQuantity').value = document.getElementById('quantity').value;
        }

        // Initialize event listeners
        document.getElementById('quantity').addEventListener('input', calculateTotal);
    </script>
@endsection
