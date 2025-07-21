@extends('templates.show')
@section('show_content')
<div class="container">
        <h2>Category Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $category->title }}</h5>
                @if(Str::startsWith($category->images, ['http://', 'https://']))
                    <img src="{{ $category->images }}" alt="Category Image" style="width: 100px; height: auto;">
                @else
                    <img src="{{ asset('storage/' . $category->images) }}" alt="Category Image" style="width: 100px; height: auto;">
                @endif
                <span class="badge bg-{{ $category->status === 'active' ? 'success' : 'secondary' }}">
                {{ ucfirst($category->status) }}
            </span>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
