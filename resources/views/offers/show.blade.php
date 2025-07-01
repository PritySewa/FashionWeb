@extends('templates.show')
@section('show_content')
    <div class="container">
        <h2>Offers Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $offers->title }}</h5>
                <p class="card-text">{{ $offers->description }}</p>
                <p class="badge bg-{{ $offers->offers }}">
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('offers.edit', $offers->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('offers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
