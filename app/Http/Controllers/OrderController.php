<?php

namespace App\Http\Controllers;

use App\Order;
use App\Inventory;
use App\StockHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(
            'user',
            'medicine',
            'pharmacy'
        )
        ->latest()
        ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order = Order::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Deduct stock only when order is delivered for the first time
        |--------------------------------------------------------------------------
        */

        if ($order->status != 'Delivered' && $request->status == 'Delivered') {

            $inventory = Inventory::where(
                'medicine_id',
                $order->medicine_id
            )->first();

            if (!$inventory) {

                return redirect()->back()->with(
                    'error',
                    'Inventory record not found.'
                );
            }

            if ($inventory->stock < $order->quantity) {

                return redirect()->back()->with(
                    'error',
                    'Not enough stock available.'
                );
            }

            $stockBefore = $inventory->stock;

            $inventory->stock -= $order->quantity;

            $inventory->save();

            /*
            |--------------------------------------------------------------------------
            | Save Stock History
            |--------------------------------------------------------------------------
            */

            StockHistory::create([

                'medicine_id'  => $order->medicine_id,

                'inventory_id' => $inventory->id,

                'user_id'      => auth()->id(),

                'action'       => 'Order Delivered',

                'quantity'     => $order->quantity,

                'stock_before' => $stockBefore,

                'stock_after'  => $inventory->stock,

                'remarks'      => 'Stock deducted after delivering Order #'.$order->id

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Order Status
        |--------------------------------------------------------------------------
        */

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}