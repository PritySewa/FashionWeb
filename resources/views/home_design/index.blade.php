@extends('templates.index')
@section('index_content')

        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold mb-4">Home Designs</h1>

            <a href="{{ route('home_design.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New</a>

            <table class="min-w-full bg-white border">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($homes as $home)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $home->title }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($home->image)
                                @if(Str::startsWith($home->image, ['http://', 'https://']))
                                    <img src="{{$home->image }}" alt="Category Image" style="width: 100px; height: auto;">
                                @else
                                    <img src="{{ asset('storage/' .$home->image) }}" style="width: 100px; height: auto;">
                                @endif
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $home->phone_no }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('home_design.show', $home->id) }}" class="text-blue-500">Show</a> |
                            <a href="{{ route('home_design.edit', $home->id) }}" class="text-yellow-500">Edit</a> |
                            <form action="{{ route('home_design.destroy', $home->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-gray-500 py-4">No home designs found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endsection
