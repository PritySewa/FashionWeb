@extends('templates.create')
@section('create_content')
    <div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Create About Us Entry</h2>

        <form action="{{ route('about-us.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('about_us.form')
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save</button>
        </form>
    </div>
@endsection
