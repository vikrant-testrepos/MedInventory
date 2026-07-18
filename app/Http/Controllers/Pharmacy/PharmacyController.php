<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Medicine;
use App\Order;

class PharmacyController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $pharmacy = $user->pharmacy;

        $totalMedicines = Medicine::where('pharmacy_id', $pharmacy->id)->count();

        $completedOrders = Order::where('pharmacy_id', $pharmacy->id)
            ->where('status', 'completed')
            ->count();

        $totalRevenue = Order::where('pharmacy_id', $pharmacy->id)
            ->where('status', 'completed')
            ->sum('total_price');

        return view('pharmacy.my-pharmacy.index', compact(
            'user',
            'pharmacy',
            'totalMedicines',
            'completedOrders',
            'totalRevenue'
        ));
    }
}