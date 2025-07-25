@extends('templates.show')
@section('show_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('home_design.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                {{ $home->title }}
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        @if(Str::startsWith($home->image, ['http://', 'https://']))
            <img src="{{ $home->image }}" alt="Category Image" style="width: 200px; height: auto; display: block; margin: 0 auto;">
        @else
            <img src="{{ asset('storage/' . $home->image) }}" style="width: 200px; height: auto; display: block; margin: 0 auto;">
        @endif

        <p ><strong>Description:</strong><br> {{ $home->description }}</p>
        <p><strong>Phone:</strong> {{ $home->phone_no }}</p>
        <p><strong>Address:</strong> {{ $home->address }}</p>
        <p><strong>Email:</strong> {{ $home->email }}</p>
    </div>

@endsection
