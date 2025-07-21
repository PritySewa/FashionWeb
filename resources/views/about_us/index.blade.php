@extends('templates.index')
@section('index_content')
    <div class="p-6 bg-white rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">About Us Entries</h2>
            <a href="{{ route('about-us.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New</a>
        </div>

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Introduction</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Features</th>
                <th class="p-2 border">Images</th>
                <th class="p-2 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($aboutUs as $item)
                <tr class="text-sm text-gray-700">
                    <td class="p-2 border">{{ $item->name }}</td>
                    <td class="p-2 border">{{ $item->introduction }}</td>
                    <td class="p-2 border">{{ $item->description }}</td>
                    <td class="p-2 border">{{ $item->features }}</td>
                    <td class="p-2 border">
                        <img src="{{ asset('storage/' . $item->images) }}" class="w-16 h-16 object-cover" />
                    </td>
                    <td class="p-2 border space-x-2">
                        <a href="{{ route('about-us.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <a href="{{ route('about-us.destroy', $item->id) }}" class="text-red-600 hover:underline" onclick="return confirm('Delete this entry?')">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
