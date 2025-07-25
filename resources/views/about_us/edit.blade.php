@extends('templates.edit')
@section('edit_content')
{{--<<<<<<< HEAD--}}
{{--    <div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">--}}
{{--        <h2 class="text-xl font-semibold mb-4">Edit About Us Entry</h2>--}}

{{--        <form action="{{ route('about_us.update', $aboutU->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">--}}
{{--=======--}}
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('about_us.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Edit About Us Entry
            </h1>
        </div>
    </div>
    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        <form action="{{ route('about_us.update', $aboutU->id)}}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
{{-->>>>>>> d5bca597b8eaf111112f870d976d9a636e8d6e70--}}
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $aboutU->id }}">
            @include('about_us.form', ['about' => $aboutU])
{{--<<<<<<< HEAD--}}
{{--            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>--}}
{{--=======--}}

            <button type="submit" style="background-color: #9F8170; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                Update
            </button>
{{-->>>>>>> d5bca597b8eaf111112f870d976d9a636e8d6e70--}}
        </form>
    </div>

@endsection
