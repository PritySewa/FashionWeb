@extends('templates.index')
@section('index_content')

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="mb-3">
            <form action="{{ route('categories.search') }}" method="GET" class="flex">
                <input type="text" id="search" class="form-control" placeholder="Search categories...">
            </form>

        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="width: 200px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route($route . 'edit', $category->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <a href="{{ route($route . 'show', $category->id) }}" class="btn btn-outline-secondary btn-sm">Show</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let value = $(this).val();

            $.ajax({
                url: "{{ route('categories.search') }}",
                type: "GET",
                data: { search: value },
                success: function (data) {
                    $('tbody').html(data);
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>
@endsection



