@extends('templates.create')
@section('create_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('categories.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create New Category
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Title*</label>
                        <input type="text" name="title" class="form-control @error('title') border-red-500 @enderror"" value="{{ old('title') }}" required>
                        @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Image</label>
                        <input type="file" name="images" class="w-full border p-2 rounded @error('images') border-red-500 @enderror">
                        @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Status*</label>
                            <select name="status" class="form-select @error('status') border-red-500 @enderror" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" style="background-color: #9F8170; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                Create
            </button>
        </form>
    </div>
@endsection
