@extends('templates.edit')
@section('edit_content')

    <div class="container mt-4">
        <h1 class="text-xl font-bold mb-4">Edit Badge</h1>

        <form action="{{ route('badges.update', $badge->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('badges.form', ['buttonText' => 'Update Badge'])

        </form>
    </div>
@endsection
