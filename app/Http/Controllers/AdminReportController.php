<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Medicine;
use App\Pharmacy;

class AdminReportController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $totalMedicines = Medicine::count();

        $totalPharmacies = Pharmacy::count();

        $totalPatients = User::where('role', 'patient')->count();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        | Count only completed orders as revenue.
        */

        $totalRevenue = Order::where('status', 'Completed')
            ->sum('total_price');

        /*
        |--------------------------------------------------------------------------
        | Orders by Status
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::where('status', 'Pending')->count();

        $acceptedOrders = Order::where('status', 'Accepted')->count();

        $preparingOrders = Order::where('status', 'Preparing')->count();

        $readyOrders = Order::where('status', 'Ready')->count();

        $completedOrders = Order::where('status', 'Completed')->count();

        $rejectedOrders = Order::where('status', 'Rejected')->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with([
                'user',
                'medicine',
                'pharmacy'
            ])
            ->latest()
            ->take(10)
            ->get();

        return view(
            'reports.index',
            compact(
                'totalOrders',
                'totalMedicines',
                'totalPharmacies',
                'totalPatients',
                'totalRevenue',
                'pendingOrders',
                'acceptedOrders',
                'preparingOrders',
                'readyOrders',
                'completedOrders',
                'rejectedOrders',
                'recentOrders'
            )
        );
    }
}