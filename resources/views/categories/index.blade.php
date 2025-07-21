@extends('templates.index')
@section('index_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <input
        type="text"
        id="search"
        placeholder="Search entries..."
        class="border p-2 mb-4 rounded w-full"
    />

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Images</th>
                    <th style="width: 200px;">Action</th>
                </tr>
                </thead>
                <tbody id="searchResults">
                @include('categories.searchresult', ['entries' => $categories])
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let timer;

            $('#search').on('keyup', function () {
                clearTimeout(timer);
                let query = $(this).val();

                timer = setTimeout(function () {
                    if (query.length === 0) {
                        $.ajax({
                            url: '{{ route("categories.index") }}',
                            type: 'GET',
                            success: function (data) {
                                const html = $(data).find('#searchResults').html();
                                $('#searchResults').html(html);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route("categories.search") }}',
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


