<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Medicine;
use App\Order;
use Illuminate\Support\Facades\Auth;

class PharmacyDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pharmacy = $user->pharmacy;

        if (!$pharmacy) {
            abort(403, 'Pharmacy not found.');
        }

        $totalMedicines = Medicine::where('pharmacy_id', $pharmacy->id)->count();

        $totalInventory = Inventory::whereHas('medicine', function ($query) use ($pharmacy) {
            $query->where('pharmacy_id', $pharmacy->id);
        })->count();

        $totalOrders = Order::where('pharmacy_id', $pharmacy->id)->count();

        $lowStock = Inventory::with('medicine')
            ->where('stock', '<=', 10)
            ->whereHas('medicine', function ($query) use ($pharmacy) {
                $query->where('pharmacy_id', $pharmacy->id);
            })
            ->orderBy('stock')
            ->take(5)
            ->get();

        $recentOrders = Order::with('medicine', 'user')
            ->where('pharmacy_id', $pharmacy->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pharmacy.dashboard', compact(
            'pharmacy',
            'totalMedicines',
            'totalInventory',
            'totalOrders',
            'lowStock',
            'recentOrders'
        ));
    }
}