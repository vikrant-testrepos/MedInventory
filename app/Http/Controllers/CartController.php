<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('medicine')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $medicine = Medicine::findOrFail($request->medicine_id);

        $cart = Cart::where('user_id', auth()->id())
            ->where('medicine_id', $medicine->id)
            ->first();

        if ($cart) {

            $cart->quantity++;

            $cart->save();

        } else {

            Cart::create([

                'user_id' => auth()->id(),

                'medicine_id' => $medicine->id,

                'quantity' => 1,

                'price' => $medicine->price

            ]);

        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Medicine added to cart.');
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}