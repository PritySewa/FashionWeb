@extends('adminlte::page')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

{{--    <div class="mb-3">--}}
{{--        <form action="{{ route($route.'index') }}" method="GET" class="flex">--}}
{{--            <input type="text" id="search" class="form-control" placeholder="Search...">--}}
{{--        </form>--}}

{{--    </div>--}}
    <div class="d-flex justify-content-between">
        <a href="{{route($route.'create')}}" class="btn btn-secondary" enctype="multipart/form-data">+ Add</a>
    </div>


    @yield('index_content')
@endsection
