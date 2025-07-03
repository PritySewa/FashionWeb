@extends('adminlte::page')

@section('content')
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Search categories...">
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="width: 200px;">Action</th>
                </tr>
                </thead>
                <tbody id="categoryTableBody">
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-outline-secondary">Show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let value = $(this).val();

                $.ajax({
                    url: "{{ route('categories.search') }}",
                    type: "GET",
                    data: { search: value },
                    success: function (data) {
                        $('#categoryTableBody').html(data);
                    },
                    error: function (xhr) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
