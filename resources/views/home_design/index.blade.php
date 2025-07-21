@extends('templates.index')
@section('index_content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold mb-4">Home Designs</h1>

            <input
                type="text"
                id="search"
                placeholder="Search entries..."
                class="border p-2 mb-4 rounded w-full"
            />

            <table class="min-w-full bg-white border">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Address
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody id="searchResults">
                @include('home_design.searchresult', ['homes' => $homes])
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
                                url: '{{ route("home_design.index") }}',
                                type: 'GET',
                                success: function (data) {
                                    const html = $(data).find('#searchResults').html();
                                    $('#searchResults').html(html);
                                }
                            });
                        } else {
                            $.ajax({
                                url: '{{ route("home_design.search") }}',
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
