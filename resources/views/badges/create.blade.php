@extends('templates.create')
@section('create_content')
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Create New Badge
            </h1>
        </div>
    </div>

    <div class="container mt-4">

        <form action="{{ route('badges.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('badges.form', ['buttonText' => 'Create Badge'])


        </form>
    </div>
@endsection
