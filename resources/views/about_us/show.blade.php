@extends('templates.show')
@section('show_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('about_us.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                About Us Details
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        @if(Str::startsWith($aboutU->images, ['http://', 'https://']))
            <img src="{{$aboutU->images }}" alt="Category Image" style="width: 200px; height: auto; display: block; margin: 0 auto;">
        @else
            <img src="{{ asset('storage/' . $aboutU->images) }}" style="width: 200px; height: auto; display: block; margin: 0 auto;">
        @endif

        <p ><strong>Name:</strong><br> {{  $aboutU->name }}</p>
        <p><strong>Introduction:</strong> {{$aboutU->introduction }}</p>
        <p><strong>Description:</strong> {{ $aboutU->description}}</p>
        <p><strong>Feature:</strong> {{ $aboutU->features }}</p>
    </div>

@endsection
