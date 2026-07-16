<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('medicine')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->count() == 0) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');

        }

        $subtotal = 0;

        foreach ($cartItems as $item) {

            $subtotal += $item->price * $item->quantity;

        }

        $delivery = 100;

        $grandTotal = $subtotal + $delivery;

        return view(
            'checkout.index',
            compact(
                'cartItems',
                'subtotal',
                'delivery',
                'grandTotal'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'phone' => 'required',

            'district' => 'required',

            'address' => 'required',

            'payment_method' => 'required'

        ]);

        $cartItems = \App\Cart::with('medicine')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->count() == 0) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');

        }

        foreach ($cartItems as $item) {

            $medicine = $item->medicine;

            if (!$medicine || $medicine->quantity < $item->quantity) {

                return redirect()
                    ->route('cart.index')
                    ->with(
                        'error',
                        'Insufficient stock for ' . $medicine->name
                    );

            }

            \App\Order::create([

                'user_id' => auth()->id(),

                'medicine_id' => $medicine->id,

                'pharmacy_id' => $medicine->pharmacy_id,

                'quantity' => $item->quantity,

                'total_price' => $item->price * $item->quantity,

                'phone' => $request->phone,

                'district' => $request->district,

                'address' => $request->address,

                'payment_method' => $request->payment_method,

                'status' => 'Pending'

            ]);

            $medicine->quantity -= $item->quantity;

            $medicine->save();

        }

        \App\Cart::where('user_id', auth()->id())->delete();

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }
}