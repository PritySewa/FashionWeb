@extends('templates.create')
@section('create_content')
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create Home Design
            </h1>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <form action="{{ route('home_design.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            @include('home_design.form', ['home' => null])

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ route('home_design.index') }}" class="text-gray-600 ml-4">Cancel</a>
        </form>
    </div>
@endsection
