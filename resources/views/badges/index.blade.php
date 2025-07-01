@extends('templates.index')
@section('index_content')
    <div class="container mt-4">
        <h1 class="text-xl font-bold mb-4">Badges List</h1>

        <a href="{{ route('badges.create') }}" class="btn btn-primary mb-3">Add New Badge</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
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
                    <td>
                        @if($badge->icon_path)
                            <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="Icon" width="32" class="rounded">
                        @else
                            <span class="text-muted">N/A</span>
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
                        <a href="{{ route('badges.show', $badge->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('badges.edit', $badge->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

@endsection
