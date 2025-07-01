@extends('templates.edit')

@section('edit_content')
    <h3>Edit Product</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
                </div>

                <div class="mb-3">
                    <label>Parent ID</label>
                    <input type="text" name="parent_id" class="form-control" value="{{ old('parent_id', $product->parent_id) }}">
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Badge</label>
                    <select name="badge_id" class="form-select">
                        <option value="">None</option>
                        @foreach($badges as $badge)
                            <option value="{{ $badge->id }}" {{ $product->badge_id == $badge->id ? 'selected' : '' }}>
                                {{ $badge->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="mb-3">
                    <input type="file" name="thumb_images_url" class="form-control" accept="image/*">
                    @if ($product->thumb_images_url)
                        <img src="{{ asset('storage/' . $product->thumb_images_url) }}" width="100">
                    @endif

                </div>


        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label>Is Variant</label>
                    <select name="is_variant" class="form-select">
                        <option value="0" {{ $product->is_variant == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $product->is_variant == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Size</label>
                    <input type="text" name="size" class="form-control" value="{{ old('size', $product->size) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" value="{{ old('color', $product->color) }}">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>Specifications</label>
            <textarea name="specifications" class="form-control" rows="3">{{ old('specifications', $product->specifications) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
