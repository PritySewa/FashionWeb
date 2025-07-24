@extends('adminlte::page')
@section('adminlte_css')
    <style>
        .content-wrapper, .main-footer, .main-header {
            background-color: #EFDECD !important;
        }
        body {
            background-color: #EFDECD !important;
        }
    </style>
@stop
@section('content')

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <div style="display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <a href="{{ route($route.'create') }}" class="btn" style="background-color: #654321; color: white;">Create/Add</a>
        </div>


    @yield('index_content')
@endsection
