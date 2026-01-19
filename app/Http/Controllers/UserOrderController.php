<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display a specific order
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['items.product']);

        return view('orders.show', compact('order'));
    }
}
