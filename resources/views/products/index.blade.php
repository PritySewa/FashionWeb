@extends('templates.index')
@section('index_content')
    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Thumbnail</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Badge</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Variant</th>
                    <th class="px-4 py-3">Size</th>
                    <th class="px-4 py-3">Color</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $product->id }}</td>
                        <td class="px-4 py-3">
                            <img src="{{$product->thumb_images_url }}" alt="Image" class="w-10 h-10 object-cover rounded-md shadow-sm" height="120px" width="120px">
                        </td>
                        <td class="px-4 py-3">{{ $product->title }}</td>
                        <td class="px-4 py-3">{{ $product->category->title ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $product->badge->title?? 'N/A' }}</td>
                        <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs font-medium text-white rounded-md bg-{{ $product->status === 'active' ? 'green' : 'red' }}-500">
                                {{ ucfirst($product->status) }}
                            </span>
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
                                <a href="{{ route($route . 'edit', $product->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a href="{{ route($route . 'show', $product->id) }}" class="btn btn-outline-secondary btn-sm">Show</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
