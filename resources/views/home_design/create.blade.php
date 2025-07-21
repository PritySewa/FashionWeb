@extends('templates.create')
@section('create_content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Create Home Design</h1>

        <form action="{{ route('home_design.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            @include('home_design.form', ['home' => null])

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ route('home_design.index') }}" class="text-gray-600 ml-4">Cancel</a>
        </form>
    </div>
@endsection
