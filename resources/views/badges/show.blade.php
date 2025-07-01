@extends('templates.show')
@section('show_content')
    <div class="container mt-4">
        <h1 class="text-2xl font-bold mb-4">{{ $badge->title }}</h1>

        <div class="mb-3">
            @if($badge->icon_url)
                <img src="{{ $badge->icon_url }}" alt="Badge Icon" width="64">
            @elseif($badge->nameicon)
                <i class="{{ $badge->nameicon }}" style="font-size: 64px;"></i>
            @else
                <p>No icon available.</p>
            @endif
        </div>

        <div class="mb-3">
            <strong>Description:</strong><br>
            <p>{{ $badge->description ?? 'No description provided.' }}</p>
        </div>

        <a href="{{ route('badges.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

@endsection
