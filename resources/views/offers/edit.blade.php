@extends('templates.edit')
@section('edit_content')
    <div class="container">
        <h2>Edit Category</h2>

        <form action="{{ route('offers.update', $offers->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $offers->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $offers->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Offers</label>
                <textarea name="offers" class="form-control" required>{{ old('offers', $offers->offers) }}</textarea>


            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('offers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
