@extends('templates.create')
@section('create_content')
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create About Us Entry
            </h1>
        </div>
    </div>

    <div class="p-6 container mt-4 bg-white rounded shadow max-w-3xl mx-auto">
        <form action="{{ route('about_us.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('about_us.form')
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
        </form>
    </div>
@endsection
