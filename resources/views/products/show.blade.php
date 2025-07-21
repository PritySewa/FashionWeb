@extends('templates.show')

@section('show_content')
    <h3 class="mb-4">Product Details</h3>

    <div class="card">
        <div class="card-body grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
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
            </div>

            <div>
                <p><strong>Thumbnail Image:</strong></p>
                @if(Str::startsWith($product->thumb_images_url, ['http://', 'https://']))
                    <img src="{{$product->thumb_images_url }}" alt="Category Image" style="width: 100px; height: auto;">
                @else
                    <img src="{{ asset('storage/' .$product->thumb_images_url) }}" alt="Category Image" style="width: 100px; height: auto;">
                @endif            </div>



                <div class="col-span-2">
                <p><strong>Description:</strong></p>
                <div class="p-3 border rounded bg-gray-50">{{ $product->description }}</div>

                <p class="mt-3"><strong>Specifications:</strong></p>
                <div class="p-3 border rounded bg-gray-50">{{ $product->specifications }}</div>
            </div>

        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
