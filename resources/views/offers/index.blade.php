@extends('templates.index')
@section('index_content')
    <div class="container py-4">
        <div class="card shadow-sm">

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
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
                                    <a href="{{ route($route . 'edit', $offer->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                    <a href="{{ route($route . 'show', $offer->id) }}" class="btn btn-outline-secondary btn-sm">Show</a>
                                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
@endsection



