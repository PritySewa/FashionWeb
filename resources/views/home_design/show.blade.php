@extends('templates.show')
@section('show_content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">{{ $home->title }}</h1>

        <div class="bg-white p-6 rounded shadow">
            @if(Str::startsWith($home->image, ['http://', 'https://']))
                <img src="{{$home->image }}" alt="Category Image" style="width: 100px; height: auto;">
            @else
                <img src="{{ asset('storage/' .$home->image) }}" style="width: 100px; height: auto;">
            @endif
                <p><strong>Description:</strong> {{ $home->description }}</p>
            <p><strong>Phone:</strong> {{ $home->phone_no }}</p>
            <p><strong>Address:</strong> {{ $home->address }}</p>
            <p><strong>Email:</strong> {{ $home->email }}</p>
        </div>

        <a href="{{ route('home_design.index') }}" class="text-blue-500 mt-4 inline-block">← Back to list</a>
    </div>
@endsection
