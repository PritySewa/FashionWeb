@extends('templates.index')

@section('index_content')
    <style>
        /* Search input styling */
        #search {
            border: 2px solid #8B4513;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem; /* rounded */
            width: 100%;
        }

        /* Table header */
        thead th {
            background-color: #654321;
            color: white;
            text-align: center;  /* <-- centered text */
        }

        #searchResults tr td {
            text-align: center; /* center body cells text */
        }

        #searchResults tr {
            background-color: white;
            color: black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                About Us Entries
            </h1>
        </div>
    </div>

    <div class="container mt-4">

    <input
        type="text"
        id="search"
        placeholder="Search entries..."
    />

    <div class="p-6 bg-white rounded shadow">

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
