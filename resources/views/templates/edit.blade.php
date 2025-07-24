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
    @yield('edit_content')
@endsection
