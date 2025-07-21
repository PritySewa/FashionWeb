@extends('templates.index')

@section('index_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="p-6 bg-white rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">About Us Entries</h2>
            <a href="{{ route('about_us.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New</a>
        </div>

        <input
            type="text"
            id="search"
            placeholder="Search entries..."
            class="border p-2 mb-4 rounded w-full"
        />

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Introduction</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Features</th>
                <th class="p-2 border">Images</th>
                <th class="p-2 border">Actions</th>
            </tr>
            </thead>
            <tbody id="searchResults">
            @include('about_us.searchresult', ['entries' => $aboutUs])
            </tbody>
        </table>
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
                            url: '{{ route("about_us.index") }}',
                            type: 'GET',
                            success: function (data) {
                                const html = $(data).find('#searchResults').html();
                                $('#searchResults').html(html);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route("about_us.search") }}',
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
