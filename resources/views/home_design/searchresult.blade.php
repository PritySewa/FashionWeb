@forelse ($homes as $home)
    <tr>
        <td class="py-2 px-4 border-b">{{ $home->title }}</td>
        <td class="py-2 px-4 border-b">{{ $home->description }}</td>

        <td class="py-2 px-4 border-b">
            @if ($home->image)
                @if(Str::startsWith($home->image, ['http://', 'https://']))
                    <img src="{{ $home->image }}" alt="{{ $home->title }} Image" style="width: 100px; height: auto;">
                @else
                    <img src="{{ asset('storage/' . $home->image) }}" alt="{{ $home->title }} Image" style="width: 100px; height: auto;">
                @endif
            @else
                <span class="text-gray-400 italic">No image</span>
            @endif
        </td>

        <td class="py-2 px-4 border-b">{{ $home->phone_no }}</td>
        <td class="py-2 px-4 border-b">{{ $home->address }}</td>
        <td class="py-2 px-4 border-b">{{ $home->email }}</td>

        <td class="py-2 px-4 border-b">
            <a href="{{ route('home_design.edit', $home->id) }}" class="btn btn-sm  text-white" style="background-color: #9F8170;">Edit</a>
            <a href="{{ route('home_design.show', $home->id) }}" class="btn btn-sm  text-white" style="background-color: #9F8170;">Show</a>
            <form action="{{ route('home_design.destroy', $home->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center text-gray-500 py-4">No home designs found.</td>
    </tr>
@endforelse
