<?php

namespace App\Http\Controllers;

use App\Order;
use App\Medicine;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('medicine','user')
                    ->latest()
                    ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $medicines = Medicine::where('quantity','>',0)->get();

        return view('orders.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);

        if ($request->quantity > $medicine->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        Order::create([
            'user_id'      => auth()->id(),
            'pharmacy_id'  => $medicine->pharmacy_id,
            'medicine_id'  => $medicine->id,
            'quantity'     => $request->quantity,
            'total_price'  => $medicine->price * $request->quantity,
            'status'       => 'Pending'
        ]);

        $medicine->quantity -= $request->quantity;
        $medicine->save();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order placed successfully.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'status'=>'required'
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;

        $order->save();

        return redirect()
            ->route('orders.index')
            ->with('success','Order updated.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $medicine = $order->medicine;

        if ($medicine) {
            $medicine->quantity += $order->quantity;
            $medicine->save();
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order deleted and stock restored.');
    }
}