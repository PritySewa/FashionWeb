@extends('templates.index')
@section('index_content')
    <div class="container mt-4">

    <!-- Add Product Button -->

    <!-- Table displaying products -->
    <table class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No User Found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
