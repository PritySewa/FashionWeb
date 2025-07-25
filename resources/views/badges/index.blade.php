@extends('templates.index')
@section('index_content')
    <style>
        /* Table header */
        thead th {
            background-color: #654321;
            color: white;
            text-align: center;  /* <-- centered text */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Badges List
            </h1>
        </div>
    </div>

    <div class="container mt-4">

        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="w-full table-bordered ">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($badges as $index => $badge)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($badge->icon_path)
                                @if(Str::startsWith($badge->icon_path, ['http://', 'https://']))
                                    <img src="{{$badge->icon_path}}" style="width: 100px; height: auto;">
                                @else
                                    <img src="{{ asset('storage/' .$badge->icon_path) }}" alt="Category Image" style="width: 100px; height: auto;">
                                @endif
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif
                        </td>


                        <td>{{ $badge->title }}</td>
                        <td>
                            @if ($badge && $badge->description)
                                {{ $badge->description }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('badges.edit', $badge->id) }}" class="btn btn-sm text-white" style="background-color: #9F8170;">Edit</a>
                            <a href="{{ route('badges.show', $badge->id) }}" class="btn btn-sm  text-white" style="background-color: #9F8170;">View</a>
                            <form action="{{ route('badges.destroy', $badge->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this badge?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
