<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class EsewaPaymentController extends Controller
{
    public function success(Request $request)
    {
        $payment = $this->decodeResponse($request->input('data'));

        if (!$payment || !$this->hasValidSignature($payment)) {
            return redirect()->route('checkout.success')
                ->with('error', 'eSewa payment verification failed.');
        }

        $transactionUuid = isset($payment['transaction_uuid'])
            ? $payment['transaction_uuid']
            : session('esewa_transaction_uuid');

        $orders = Order::with('medicine')
            ->where('transaction_uuid', $transactionUuid)
            ->where('user_id', auth()->id())
            ->get();

        if ($orders->isEmpty() || $payment['status'] !== 'COMPLETE') {
            return redirect()->route('checkout.success')
                ->with('error', 'eSewa did not complete this payment.');
        }

            $expectedAmount = number_format($orders->sum('total_price') + 100, 2, '.', '');

            if ((string) $payment['total_amount'] !== $expectedAmount) {
                return redirect()->route('checkout.success')
                ->with('error', 'The eSewa payment amount could not be verified.');
            }

        $orders->each(function ($order) use ($payment) {
            $order->payment_status = 'paid';
            $order->payment_reference = $payment['transaction_code'];
            $order->save();
        });

        \App\Cart::where('user_id', auth()->id())->delete();
        session()->forget('esewa_transaction_uuid');

        return redirect()->route('checkout.success')
            ->with('success', 'eSewa payment completed successfully.');
    }

    public function failure()
    {
        $payment = $this->decodeResponse(request('data'));
        $transactionUuid = $payment && isset($payment['transaction_uuid'])
            ? $payment['transaction_uuid']
            : request('transaction_uuid', session('esewa_transaction_uuid'));

        $orders = Order::with('medicine')
            ->where('transaction_uuid', $transactionUuid)
            ->where('user_id', auth()->id())
            ->get();

        foreach ($orders as $order) {
            if ($order->medicine) {
                $order->medicine->quantity += $order->quantity;
                $order->medicine->save();
            }

            $order->payment_status = 'failed';
            $order->status = 'Cancelled';
            $order->save();
        }

        session()->forget('esewa_transaction_uuid');

        return redirect()->route('checkout.success')
            ->with('error', 'eSewa payment was cancelled or failed.');
    }

    private function decodeResponse($encoded)
    {
        if (!$encoded) {
            return null;
        }

        $decoded = base64_decode($encoded, true);
        $payment = $decoded ? json_decode($decoded, true) : null;

        return is_array($payment) ? $payment : null;
    }

    private function hasValidSignature(array $payment)
    {
        if (empty($payment['signed_field_names']) || empty($payment['signature'])) {
            return false;
        }

        $fields = explode(',', $payment['signed_field_names']);
        $signedData = [];

        foreach ($fields as $field) {
            if (!array_key_exists($field, $payment)) {
                return false;
            }

            $signedData[] = $field . '=' . $payment[$field];
        }

        $signature = base64_encode(hash_hmac(
            'sha256',
            implode(',', $signedData),
            config('services.esewa.secret'),
            true
        ));

        return hash_equals($signature, $payment['signature']);
    }
}
