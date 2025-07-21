@extends('templates.edit')
@section('edit_content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Home Design</h1>

        <form action="{{ route('home_design.update', $home->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            @include('home_design.form', ['home' => $home])

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('home_design.index') }}" class="text-gray-600 ml-4">Cancel</a>
        </form>
    </div>
@endsection
