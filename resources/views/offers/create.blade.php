@extends('templates.create')
@section('create_content')
    <div class="container">
        <div style="text-align: center;">
            <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
                <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                    Create New Offers
                </h1>
            </div>
        </div>
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
