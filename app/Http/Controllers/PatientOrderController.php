<?php

namespace App\Http\Controllers;

use App\Order;

class PatientOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('medicine', 'pharmacy')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('patient.orders', compact('orders'));
    }
}