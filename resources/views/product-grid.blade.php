@extends('template')
@section('content')
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="border p-4 rounded shadow">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-2">
            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
            <p class="text-sm text-gray-600">{{ $product->price }} NPR</p>
        </div>
    @empty
        <p class="col-span-full text-center text-gray-500">No products found.</p>
    @endforelse
</div>
@endsection
