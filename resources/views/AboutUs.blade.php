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

    <div class="max-w-6xl mx-auto px-6 py-12 font-sans">
        <!-- Header with Name Only -->


        <!-- Main Content Section with Image and Text -->
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            <!-- Image Section -->
            <div class="w-full lg:w-1/2">
                <div class="relative group">
                    @if(Str::startsWith($aboutu->images, ['http://', 'https://']))
                        <img src="{{ $aboutu->images }}" alt="{{$aboutu->name}}"
                             class="rounded-xl shadow-2xl w-full h-auto transform group-hover:scale-105 transition duration-500">
                    @else
                        <img src="{{ asset('storage/' . $aboutu->images) }}" alt="{{$aboutu->name}}"
                             class="rounded-xl shadow-2xl w-full h-auto transform group-hover:scale-105 transition duration-500">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent rounded-xl"></div>
                </div>
            </div>

            <!-- Text Content Section -->
            <div class="w-full lg:w-1/2 space-y-8">
                <!-- Introduction -->
                <div class="space-y-4">
                    <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 text-gray-900 italic text-shadow">
                        Welcome</h2>
                    <div class="bg-[#A9746E] bg-opacity-20 inline-block w-fit px-3 py-1  mb-4 rounded-lg ">
                        <span class="text-l font-medium tracking-widest text-[#8B4513] uppercase">{{$aboutu->introduction}}</span>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <div class="bg-[#A9746E] bg-opacity-10 border border-[#A9746E] shadow-lg rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-[#8B4513]">Our Story</h2>
                        <p class="text-gray-700 text-1xl leading-relaxed">
                            {{$aboutu->description}}
                        </p>
                    </div>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <div class="bg-[#A9746E] bg-opacity-10 border border-[#A9746E] shadow-lg rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-[#8B4513]">Why Choose Us</h2>
                        <p class="text-gray-700 text-1xl leading-relaxed">
                            {{$aboutu->feature}}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
