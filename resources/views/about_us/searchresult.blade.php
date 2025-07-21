@foreach ($entries as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->introduction }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->features }}</td>
        <td>
            @if ($item->images)
                @if(Str::startsWith($item->images, ['http://', 'https://']))
                    <img src="{{ $item->images }}" alt="Image" style="width: 100px;">
                @else
                    <img src="{{ asset('storage/' . $item->images) }}" alt="Image" style="width: 100px;">
                @endif
            @else
                <span class="text-gray-400 italic">No image</span>
            @endif
        </td>
        <td>
            <a href="{{ route('about_us.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('about_us.show', $item->id) }}" class="text-red-600 hover:underline">Show</a>
            <form action="{{ route('about_us.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Delete this item?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

@if ($entries->isEmpty())
    <tr>
        <td colspan="6" class="text-center text-gray-500">No entries found.</td>
    </tr>
@endif
