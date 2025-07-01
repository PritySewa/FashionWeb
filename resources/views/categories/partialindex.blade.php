@extends('templates.index')
@section('index_content')
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->title }}</td>
        <td>{{ $category->description }}</td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-secondary btn-sm">Show</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
@endsection
