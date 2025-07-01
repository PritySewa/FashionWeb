@extends('templates.index')
@section('index_content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
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
                </tr>
                </thead>
                <tbody>
                @foreach($order as $orders)
                    @foreach($orders->orderitems as $item)
                        <tr>
                            <td>{{ $orders->id }}</td>
                            <td>{{ $item->product->title ?? 'N/A' }}</td>
                            <td>{{ $item->product->price ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $orders->address ?? 'N/A' }}</td>
                            <td>{{ $orders->phone_number }}</td>
                            <td>{{ $item->total_price}}</td>
                            <td>{{ $orders->payment_method }}</td>
                        </tr>
                    @endforeach
                @endforeach

            </table>
        </div>
    </div>
@endsection
