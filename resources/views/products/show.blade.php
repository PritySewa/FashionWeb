@extends('templates.show')

@section('show_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('products.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Product Details
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        <p><strong>Thumbnail Image:</strong></p>
        @if(Str::startsWith($product->thumb_images_url, ['http://', 'https://']))
            <img src="{{$product->thumb_images_url }}" alt="Category Image" style="width: 100px; height: auto;">
        @else
            <img src="{{ asset('storage/' .$product->thumb_images_url) }}" alt="Category Image" style="width: 100px; height: auto;">
        @endif
        <p><strong>Title:</strong> {{ $product->title }}</p>
        <p><strong>Parent ID:</strong> {{ $product->parent_id ?? 'N/A' }}</p>
        <p><strong>Category:</strong> {{ $product->category->title ?? 'N/A' }}</p>
        <p><strong>Badge:</strong> {{ $product->badge->title ?? 'N/A' }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($product->status) }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Is Variant:</strong> {{ $product->is_variant ? 'Yes' : 'No' }}</p>
        <p><strong>Size:</strong> {{ $product->size }}</p>
        <p><strong>Color:</strong>
            <span class="inline-block w-5 h-5 rounded-full align-middle border border-gray-300"
                  style="background-color: {{ $product->color }}"></span>
            <span class="ml-2">{{ $product->color }}</span>
        </p>
        <p><strong>Description:</strong></p>
        <div class="p-3 border rounded bg-gray-50">{{ $product->description }}</div>

        <p class="mt-3"><strong>Specifications:</strong></p>
        <div class="p-3 border rounded bg-gray-50">{{ $product->specifications }}</div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($product->image_urls ?? [] as $img)
                <img src="{{ asset('storage/' . $img) }}" class="w-full h-32 object-cover rounded shadow">
            @endforeach
        </div>
    </div>


@endsection
