<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Medicine;
use App\Order;
use App\Pharmacy;
use Illuminate\Support\Facades\Auth;

class PharmacyDashboardController extends Controller
{
    public function index()
    {
        // Logged in pharmacy user
        $pharmacy = Pharmacy::where('user_id', Auth::id())->first();

        // If pharmacy profile doesn't exist yet
        if (!$pharmacy) {

            return view('pharmacy.dashboard', [

                'totalMedicines' => 0,
                'totalInventory' => 0,
                'pendingOrders' => 0,
                'completedOrders' => 0,
                'recentOrders' => collect(),
                'lowStock' => collect()

            ]);

        }

        // Statistics
        $totalMedicines = Medicine::where('pharmacy_id', $pharmacy->id)->count();

        $medicineIds = Medicine::where('pharmacy_id', $pharmacy->id)->pluck('id');

        $totalInventory = Inventory::whereIn('medicine_id', $medicineIds)->count();

        $pendingOrders = Order::where('pharmacy_id', $pharmacy->id)
                            ->where('status', 'Pending')
                            ->count();

        $completedOrders = Order::where('pharmacy_id', $pharmacy->id)
                            ->where('status', 'Delivered')
                            ->count();

        $recentOrders = Order::with('user', 'medicine')
                            ->where('pharmacy_id', $pharmacy->id)
                            ->latest()
                            ->take(5)
                            ->get();

        $lowStock = Inventory::with('medicine')
                        ->whereIn('medicine_id', $medicineIds)
                        ->where('stock', '<=', 10)
                        ->orderBy('stock')
                        ->take(5)
                        ->get();

        return view('pharmacy.dashboard', compact(

            'totalMedicines',
            'totalInventory',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'lowStock'

        ));
    }
}