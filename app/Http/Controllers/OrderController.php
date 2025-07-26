<?php

namespace App\Http\Controllers;

use App\Models\Offer_Item;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Product;
use App\Notifications\OrderConfirmed;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct()
{
    $this->title = "Orders";
    $this->resources = "orders.";
    $this->route = "orders";
    parent::__construct();
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $info = $this->crudInfo();
        $info['order'] = Order::with(['user', 'orderitems.product'])->get();
        return view($this->indexResource(), $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->crudInfo();
        return view($this->createResource(),$info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'payment_method' => 'required|in:cash_on_delivery,skypay',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user = auth()->user();
        $quantity = $request->quantity;
        // ⚠️ Add this stock check here
//        if ($product->stock < $quantity) {
//            return back()->with('error', 'Not enough stock for this product.');
//        }


        $total_price = $request->quantity * $product->price;
        // Calculate payment status
        $isPaid = $request->paid_amount >= $total_price;

        $order = Order::create([
            'phone_number' => $request->phone_number,
            'user_id' => $user->id,
            'total_discount' => 0, // or apply your discount logic
            'payment_method' => $request->payment_method,
            'payment_verified_at' => $isPaid ? now() : null,
            'cancelled_at_status' => now(), // you may want to make this nullable in migration
            'address' => $request->address,
            'payment_status' => $isPaid ? 'paid' : 'unpaid',
            'completed_at_sales_total' => null,
        ]);
//        if ($isPaid) {
//            $product->stock -= $quantity;
//
//            // Prevent negative stock
//            if ($product->stock < 0) {
//                $product->stock = 0;
//            }

//            $product->save();
//        }
        Order_Item::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'product_title' => $product->title,
            'product_image_url' => $product->thumb_images_url,
            'product_price' => $product->price,
            'total_price' => $total_price,
            'status' => 0, // 👈 this fixes your error


        ]);

                $user->notify(new OrderConfirmed($order));
//                Redirect to Skypay if selected
//        $total_price = $request->source == 'direct'
//            ?$request->quantity * $product->price
//            :$request->cart_total_price;
        if ($request->payment_method === "skypay") {

            $redirectUrl = sprintf(
                'https://checkout.skypay.dev?api_key=%s&amount=%s&code=%s&success_url=%s&failure_url=%s',
                env('SKYPAY_API_KEY'),
                $total_price,
                $order->id,
                route('success'),
                route('failure')
            );
            return redirect()->intended($redirectUrl)->with('success', 'Booking created successfully with Skypay Payment!');
        }

        return redirect()->route('success', $order->id)->with('success', 'Order placed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

            $orders = Order::findOrFail($id);
            return view($this->editResource(), compact('orders'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $orders = Order::with('orderitems.product')
            ->where('id', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->orWhere('phone_number', 'like', "%{$query}%")
            ->orWhere('payment_method', 'like', "%{$query}%")
            ->get();

        return view('orders.searchresult', ['order' => $orders]);    }
}

