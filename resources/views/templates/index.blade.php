@extends('adminlte::page')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="d-flex justify-content-between">
        <a href="{{route($route.'create')}}" class="btn btn-secondary" enctype="multipart/form-data">+ Add</a>
    </div>


    @yield('index_content')
@endsection
