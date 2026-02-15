<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'total' => 'required|numeric',
            'cart' => 'required|array'
        ]);

        // Create the order
        $order = Order::create([
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'total_amount' => $validated['total']
        ]);

        // Add items to order
        foreach ($validated['cart'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);
    }
}
