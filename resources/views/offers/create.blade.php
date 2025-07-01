@extends('templates.create')
@section('create_content')
    <div class="container">
        <h2>Create New Category</h2>

        <form action="{{ route('offers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Offers</label>

            </div>

            <button type="submit" class="btn btn-success">Create</button>
            <textarea name="offers" class="form-control" required>{{ old('description') }}</textarea>

            <a href="{{ route('offers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
    </div>
@endsection
