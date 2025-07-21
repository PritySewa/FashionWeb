@extends('templates.show')
@section('show_content')
    <div class="p-6 bg-white rounded shadow max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">About Us Details</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Textual Info -->
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-gray-700">Name</h3>
                    <p class="text-gray-900">{{ $aboutU->name }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700">Introduction</h3>
                    <p class="text-gray-900">{{ $aboutU->introduction }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700">Description</h3>
                    <p class="text-gray-900">{{ $aboutU->description }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-700">Features</h3>
                    <p class="text-gray-900">{{ $aboutU->features }}</p>
                </div>
            </div>

            <!-- Image -->
            <div class="flex items-center justify-center">
                <div class="w-64 h-64 overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $aboutU->images) }}"
                         alt="About Us Image"
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
@endsection
