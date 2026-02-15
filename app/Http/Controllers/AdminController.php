<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        
        return view('admin.dashboard', compact('orders', 'totalOrders', 'totalRevenue'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.order-details', compact('order'));
    }
}
