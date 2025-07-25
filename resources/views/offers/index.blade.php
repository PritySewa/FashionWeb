@extends('templates.index')
@section('index_content')
    <style>

        /* Table header */
        thead th {
            background-color: #654321;
            color: white;
            text-align: center;  /* <-- centered text */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
    <div style="text-align: center;">
        <div style="background-color: rgba(169, 116, 110, 0.2); display: inline-block; padding: 0.5rem 1rem; border-radius: 0.5rem;">
            <h1 style="color: #8B4513; font-size: 1.25rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase; margin: 0;">
                Offers
            </h1>
        </div>
    </div>
    <div class="container py-4">
        <div class="card shadow-sm">

            <div class="card-body p-0">
                <table class="w-full table-bordered ">
                    <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Offers</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td>{{$offer->title }}</td>
                            <td>{{ $offer->description }}</td>
                            <td>{{ $offer->offers}}</td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route($route . 'edit', $offer->id) }}" class="btn btn-sm  text-white" style="background-color: #9F8170;">Edit</a>
                                    <a href="{{ route($route . 'show', $offer->id) }}" class="btn btn-sm  text-white" style="background-color: #9F8170;">Show</a>
                                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
@endsection



