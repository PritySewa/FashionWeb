@extends('templates.show')
@section('show_content')
    <div class="container mt-4">
        <p>Title</p>
        <h1 class="text-2xl font-bold mb-4">{{ $badge->title }}</h1>

        <div class="mb-3">
            <p>Icon</p>
                @if(Str::startsWith($badge->icon_path, ['http://', 'https://']))
                    <img src="{{$badge->icon_path}}" style="width: 100px; height: auto;">
                @else
                    <img src="{{ asset('storage/' .$badge->icon_path) }}" alt="Category Image" style="width: 100px; height: auto;">
            @endif
        </div>

        <div class="mb-3">
            <strong>Description:</strong><br>
            <p>{{ $badge->description ?? 'No description provided.' }}</p>
        </div>

        <a href="{{ route('badges.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

@endsection
