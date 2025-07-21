@foreach($order as $orders)
    @foreach($orders->orderitems as $item)
        <tr>
            <td>{{ $orders->id }}</td>
            <td>{{ $item->product->title ?? 'N/A' }}</td>
            <td>{{ $item->product->price ?? 'N/A' }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $orders->address ?? 'N/A' }}</td>
            <td>{{ $orders->phone_number }}</td>
            <td>{{ $item->total_price }}</td>
            <td>{{ $orders->payment_method }}</td>
        </tr>
    @endforeach
@endforeach

@if ($order->isEmpty())
    <tr>
        <td colspan="8" class="text-center text-muted">No orders found.</td>
    </tr>
@endif
