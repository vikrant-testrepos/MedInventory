<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'medicine',
            'medicine.pharmacy'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

        return view(
            'patient.orders.index',
            compact('orders')
        );
    }

    public function show(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        return view(
            'patient.orders.show',
            compact('order')
        );
    }
}