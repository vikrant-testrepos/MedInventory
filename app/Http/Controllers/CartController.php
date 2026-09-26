<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['medicine', 'medicine.pharmacy'])
            ->where('user_id', auth()->id())
            ->get();

        $grandTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'grandTotal'));
    }

    public function store(Request $request)
    {
        $medicine = Medicine::findOrFail($request->medicine_id);

        $cart = Cart::where('user_id', auth()->id())
            ->where('medicine_id', $medicine->id)
            ->first();

        if ($cart) {

            $cart->quantity += 1;

            $cart->save();

        } else {

            Cart::create([
                'user_id'     => auth()->id(),
                'medicine_id' => $medicine->id,
                'quantity'    => 1,
                'price'       => $medicine->price,
            ]);

        }

        return redirect()
            ->back()
            ->with('success', 'Medicine added to cart.');
    }

    public function increase($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->findOrFail($id);

        $cart->quantity++;

        $cart->save();

        return back();
    }

    public function decrease($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->findOrFail($id);

        if ($cart->quantity > 1) {

            $cart->quantity--;

            $cart->save();

        }

        return back();
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->findOrFail($id);

        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}