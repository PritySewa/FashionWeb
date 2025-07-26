@extends('template')
@section('content')
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display&display=swap" rel="stylesheet">
    </head>

    <div class="max-w-5xl mx-auto px-4 py-16 font-sans">
        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <!-- Image Section -->
            <div class="w-full lg:w-1/2">
                <div class="relative overflow-hidden rounded-lg aspect-[4/5]">
                    @if(Str::startsWith($aboutu->images, ['http://', 'https://']))
                        <img src="{{ $aboutu->images }}" alt="{{$aboutu->name}}"
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    @else
                        <img src="{{ asset('storage/' . $aboutu->images) }}" alt="{{$aboutu->name}}"
                             class="w-full h-full object-cover transition duration-500 hover:scale-105">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-black/5 to-transparent"></div>
                </div>
            </div>

            <!-- Text Content Section -->
            <div class="w-full lg:w-1/2 space-y-8">
                <!-- Introduction -->
                <div class="space-y-6">
                    <h2 class="text-3xl font-serif font-medium text-gray-800">
                        Welcome
                    </h2>
                    <div class="inline-block px-4 py-2 bg-[#F5F0ED] rounded-full">
                        <span class="text-sm font-medium tracking-wider text-[#8B4513]">
                            {{$aboutu->introduction}}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                        <h2 class="text-xl font-semibold text-[#8B4513] mb-3">Our Story</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{$aboutu->description}}
                        </p>
                    </div>
                </div>

                <!-- Features -->
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                        <h2 class="text-xl font-semibold text-[#8B4513] mb-3">Why Choose Us</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{$aboutu->feature}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
