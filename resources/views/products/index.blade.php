@extends('templates.index')
@section('index_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <input
        type="text"
        id="search"
        placeholder="Search entries..."
        class="border p-2 mb-4 rounded w-full"
    />
    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Thumbnail</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Badge</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Variant</th>
                    <th class="px-4 py-3">Size</th>
                    <th class="px-4 py-3">Color</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody id="searchResults">
                @include('products.searchresult', ['entries' => $products])
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
                            url: '{{ route("products.index") }}',
                            type: 'GET',
                            success: function (data) {
                                const html = $(data).find('#searchResults').html();
                                $('#searchResults').html(html);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route("products.searching") }}',
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
