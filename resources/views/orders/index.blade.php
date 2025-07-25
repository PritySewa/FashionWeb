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
                Orders List
            </h1>
        </div>
    </div>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <input
                type="text"
                id="search"
                placeholder="Search entries..."
            />

        <div class="table-responsive">
            <table class="w-full table-bordered ">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Total Amount</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody id="searchResults">
                @include('orders.searchresult', ['order' => $order])
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
                            url: '{{ route("orders.index") }}',
                            type: 'GET',
                            success: function (data) {
                                const html = $(data).find('#searchResults').html();
                                $('#searchResults').html(html);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route("orders.search") }}',
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



