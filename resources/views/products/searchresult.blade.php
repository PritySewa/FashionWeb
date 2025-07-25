@foreach($entries as $product)
    <tr class="hover:bg-gray-50 transition">
        <td class="px-4 py-3">{{ $product->id }}</td>
        <td class="px-4 py-3">{{ $product->title }}</td>
        <td class="py-2 px-4 border-b">
            @if ($product->thumb_images_url)
                @if(Str::startsWith($product->thumb_images_url, ['http://', 'https://']))
                    <img src="{{ $product->thumb_images_url }}" alt="Image" style="width: 100px;">
                @else
                    <img src="{{ asset('storage/' . $product->thumb_images_url) }}" alt="Image" style="width: 100px;">
                @endif
            @else
                <span class="text-gray-400 italic">No image</span>
            @endif
        </td>
        <td class="px-4 py-3">{{ $product->category->title ?? 'N/A' }}</td>
        <td class="px-4 py-3">{{ $product->badge->title ?? 'N/A' }}</td>
        <td class="px-4 py-3">Rs{{ number_format($product->price, 2) }}</td>
        <td class="px-4 py-3">{{$product->status}}
        </td>
        <td class="px-4 py-3">{{ $product->stock }}</td>
        <td class="px-4 py-3">{{ $product->is_variant ? 'Yes' : 'No' }}</td>
        <td class="px-4 py-3">{{ $product->size }}</td>
        <td class="px-4 py-3">{{ $product->color }}</td>
        <td class="px-4 py-3 max-w-xs truncate" title="{{ $product->description }}">
            {{ Str::limit($product->description, 50) }}
        </td>
        <td>
            <div class="flex-col gap-5">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm">Show</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach

@if($entries->isEmpty())
    <tr>
        <td colspan="13" class="text-center text-muted">No matching products found.</td>
    </tr>
@endif
