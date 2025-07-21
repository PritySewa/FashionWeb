@foreach($entries as $category)
    <tr>
        <td>{{ $category->title }}</td>
        <td class="py-2 px-4 border-b">
            @if ($category->images)
                @if(Str::startsWith($category->images, ['http://', 'https://']))
                    <img src="{{ $category->images }}" alt="Category Image" style="width: 100px;">
                @else
                    <img src="{{ asset('storage/' . $category->images) }}" alt="Category Image" style="width: 100px;">
                @endif
            @else
                <span class="text-gray-400 italic">No image</span>
            @endif
        </td>
        <td>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-outline-secondary">Show</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

@if ($entries->isEmpty())
    <tr>
        <td colspan="3" class="text-center text-muted">No categories found.</td>
    </tr>
@endif
