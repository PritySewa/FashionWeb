@extends('templates.create')
@section('create_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('products.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create New Product
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        <form action="{{ route($route . 'store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Title*</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent ID</label>
                        <input type="text" name="parent_id" class="form-control" value="{{ old('parent_id') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category*</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Badge*</label>
                        <select name="badge_id" class="form-select" required>
                            <option value="">Select Badge</option>
                            @foreach($badges as $badge)
                                <option value="{{ $badge->id }}" {{ old('badge_id') == $badge->id ? 'selected' : '' }}>
                                    {{ $badge->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price*</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail Image*</label>
                        <input type="file" name="thumb_images_url" class="form-control" accept="image/*" required>
                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG, GIF)</small>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status*</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Stock*</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Is Variant</label>
                                <select name="is_variant" class="form-select">
                                    <option value="0" {{ old('is_variant') == '0' ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('is_variant') == '1' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description*</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Size</label>
                                <input type="text" name="size" class="form-control" value="{{ old('size') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <input type="text" name="color" class="form-control" value="{{ old('color') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Specifications</label>
                        <textarea name="specifications" class="form-control" rows="3">{{ old('specifications') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gallery Images</label>
                        <input type="file" name="gallery_images[]" multiple accept="image/*"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <p class="text-xs text-gray-500 mt-1">Max 2MB each (JPEG, PNG, JPG, GIF)</p>
                    </div>
                </div>
            </div>
            <button type="submit" style="background-color: #9F8170; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                Create
            </button>
        </form>
    </div>
@endsection


