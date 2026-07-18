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
        $pharmacy = Pharmacy::where('user_id', Auth::id())->first();

        if (!$pharmacy) {

            return view('pharmacy.dashboard', [

                'totalMedicines'  => 0,
                'totalInventory'  => 0,
                'pendingOrders'   => 0,
                'completedOrders' => 0,
                'totalOrders'     => 0,
                'totalRevenue'    => 0,
                'recentOrders'    => collect(),
                'lowStock'        => collect(),
                'monthlyRevenue'  => []

            ]);
        }

        $medicineIds = Medicine::where('pharmacy_id', $pharmacy->id)->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalMedicines = Medicine::where('pharmacy_id', $pharmacy->id)->count();

        $totalInventory = Inventory::whereIn('medicine_id', $medicineIds)->count();

        $pendingOrders = Order::where('pharmacy_id', $pharmacy->id)
            ->where('status', 'Pending')
            ->count();

        $completedOrders = Order::where('pharmacy_id', $pharmacy->id)
            ->where('status', 'Completed')
            ->count();

        $totalOrders = Order::where('pharmacy_id', $pharmacy->id)->count();

        $totalRevenue = Order::where('pharmacy_id', $pharmacy->id)
            ->where('status', 'Completed')
            ->sum('total_price');

        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with(['user', 'medicine'])
            ->where('pharmacy_id', $pharmacy->id)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Low Stock Medicines
        |--------------------------------------------------------------------------
        */

        $lowStock = Inventory::with('medicine')
            ->whereIn('medicine_id', $medicineIds)
            ->where('stock', '<=', 10)
            ->orderBy('stock')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Monthly Revenue
        |--------------------------------------------------------------------------
        */

        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {

            $monthlyRevenue[] = Order::where('pharmacy_id', $pharmacy->id)
                ->where('status', 'Completed')
                ->whereMonth('created_at', $month)
                ->sum('total_price');
        }

        return view('pharmacy.dashboard', compact(

            'totalMedicines',
            'totalInventory',
            'pendingOrders',
            'completedOrders',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'lowStock',
            'monthlyRevenue'

        ));
    }
}