@extends('templates.create')
@section('create_content')
    <div class="container mt-4">
        <h1 class="text-xl font-bold mb-4">Badge Assignment</h1>

        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('badges.assign') }}" class="flex gap-4 items-center mb-4">
            <div>
                <label class="block text-sm font-medium">Badge</label>
                <select name="badge_id" class="form-control">
                    <option value="">Select Badge</option>
                    @foreach($badges as $badge)
                        <option value="{{ $badge->id }}" {{ $badge->id == $selectedBadgeId ? 'selected' : '' }}>
                            {{ $badge->title}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) $category->id === (string) $selectedCategoryId ? 'selected' : '' }}>

                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </form>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <form method="POST" action="{{ route('badges.assign') }}">
                @csrf

                <input type="hidden" name="badge_id" value="{{ $selectedBadgeId }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <div class="border p-3 rounded shadow-sm">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}">
                                <img src="{{ $product->thumb_image_url }}" class="h-16 w-16 object-cover rounded">
                                <div>
                                    <div class="font-semibold">{{ $product->title }}</div>
                                    <div class="text-sm text-muted">{{ $product->price }} | Stock: {{ $product->stock }}</div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        @elseif(request()->has('category_id'))
            <p>No eligible products found in this category without a badge.</p>
        @endif
    </div>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').select2({
                placeholder: 'Select a category',
                allowClear: true
            });
        });
    </script>
@endpush
