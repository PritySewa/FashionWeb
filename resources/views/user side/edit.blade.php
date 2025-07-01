@extends('templates.edit')
@section('edit_content')
    <div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Edit About Us Entry</h2>

        <form action="{{ route('about-us.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="id" value="{{ $about->id }}">
            @include('about_us.form', ['about' => $about])
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
@endsection
