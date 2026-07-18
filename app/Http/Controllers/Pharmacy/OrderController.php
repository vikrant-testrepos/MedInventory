<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
                'user',
                'medicine'
            ])
            ->where(
                'pharmacy_id',
                Auth::user()->pharmacy->id
            )
            ->latest()
            ->paginate(10);

        return view(
            'pharmacy.orders.index',
            compact('orders')
        );
    }

    public function show(Order $order)
    {
        if (
            $order->pharmacy_id !=
            Auth::user()->pharmacy->id
        ) {

            abort(403);

        }

        $order->load([
            'user',
            'medicine',
            'pharmacy'
        ]);

        return view(
            'pharmacy.orders.show',
            compact('order')
        );
    }

    public function update(Request $request, Order $order)
    {
        if ($order->pharmacy_id != auth()->user()->pharmacy->id) {

            abort(403);

        }

        $request->validate([

            'status' => 'required|in:Pending,Accepted,Preparing,Ready,Completed,Rejected'

        ]);

        $order->status = $request->status;

        $order->save();

        return redirect()
            ->route('pharmacy.orders.show', $order->id)
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }
    
}