@if($products->count())
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
            </div>
        @endforeach
    </div>
@else
    <p>No products found in this category.</p>
@endif
