@extends('templates.create')
@section('create_content')
    <div class="container mt-4">
        <h1 class="text-xl font-bold mb-4">Create New Badge</h1>

        <form action="{{ route('badges.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('badges.form', ['buttonText' => 'Create Badge'])


        </form>
    </div>
@endsection
