@extends('templates.create')
@section('create_content')
    <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
        <a href="{{ route('home_design.index') }}" class="btn" style="background-color: #654321; color: white;">Go back</a>
    </div>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create Home Design
            </h1>
        </div>
    </div>

    <div style="padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 768px; margin: 2rem auto;">
        <form action="{{ route('home_design.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf
            @include('home_design.form', ['home' => null])

            <button type="submit" style="background-color: #9F8170; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                Create
            </button>
        </form>
    </div>

@endsection

