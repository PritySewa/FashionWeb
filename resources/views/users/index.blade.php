@extends('templates.index')
@section('index_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="container mt-4">
        <input
            type="text"
            id="search"
            placeholder="Search entries..."
            class="border p-2 mb-4 rounded w-full"
        />
    <table class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody id="searchResults"> <!-- ✅ correct -->
        @include('users.searchresult', ['users' => $users])
        </tbody>
    </table>
        <script>
            $(document).ready(function () {
                let timer;

                $('#search').on('keyup', function () {
                    clearTimeout(timer);
                    let query = $(this).val();

                    timer = setTimeout(function () {
                        if (query.length === 0) {
                            $.ajax({
                                url: '{{ route("users.index") }}',
                                type: 'GET',
                                success: function (data) {
                                    const html = $(data).find('#searchResults').html();
                                    $('#searchResults').html(html);
                                }
                            });
                        } else {
                            $.ajax({
                                url: '{{ route("users.search") }}',
                                type: 'GET',
                                data: { query: query },
                                success: function (data) {
                                    $('#searchResults').html(data);
                                },
                                error: function (xhr) {
                                    console.error("Search error:", xhr.responseText);
                                }
                            });
                        }
                    }, 300);
                });
            });
        </script>
@endsection




