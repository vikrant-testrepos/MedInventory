<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $cartItems = Cart::with('medicine')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->count() == 0) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');

        }

        $transactionUuid = (string) Str::uuid();
        $isEsewa = $request->payment_method === 'eSewa';

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

                'transaction_uuid' => $isEsewa ? $transactionUuid : null,

                'payment_status' => $isEsewa ? 'unpaid' : 'pending',

                'status' => 'Pending'

            ]);

            $medicine->quantity -= $item->quantity;

            $medicine->save();

        }

        if ($isEsewa) {
            session(['esewa_transaction_uuid' => $transactionUuid]);

            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $totalAmount = number_format($subtotal + 100, 2, '.', '');
            $signedFields = 'total_amount,transaction_uuid,product_code';
            $signaturePayload = 'total_amount=' . $totalAmount
                . ',transaction_uuid=' . $transactionUuid
                . ',product_code=' . config('services.esewa.product_code');

            return view('checkout.esewa', [
                'totalAmount' => $totalAmount,
                'transactionUuid' => $transactionUuid,
                'signedFields' => $signedFields,
                'signature' => base64_encode(hash_hmac(
                    'sha256',
                    $signaturePayload,
                    config('services.esewa.secret'),
                    true
                )),
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('checkout.success');
    }
}