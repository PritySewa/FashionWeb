@extends('template')
@section('content')
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
                    <h2 class="text-3xl font-bold text-gray-800">Welcome</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        {{$aboutu->introduction}}
                    </p>
                </div>

                <!-- Description -->
                <div class="space-y-4 bg-blue-50 p-6 rounded-xl border border-blue-100">
                    <h2 class="text-2xl font-semibold text-blue-800">Our Story</h2>
                    <p class="text-gray-700 leading-relaxed">
                        {{$aboutu->description}}
                    </p>
                </div>

                <!-- Features -->
                <div class="space-y-4 bg-purple-50 p-6 rounded-xl border border-purple-100">
                    <h2 class="text-2xl font-semibold text-purple-800">Why Choose Us</h2>
                    <p class="text-gray-700 leading-relaxed">
                        {{$aboutu->feature}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
