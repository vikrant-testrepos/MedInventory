<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;
use App\Pharmacy;
use App\Inventory;
use App\User;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalMedicines   = Medicine::count();
        $totalCategories  = Category::count();
        $totalOrders      = Order::count();
        $totalPharmacies  = Pharmacy::count();
        $totalPatients    = User::where('role', 'patient')->count();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Order::whereIn('status', [
            'Completed',
            'Delivered'
        ])->sum('total_price');

        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyRevenue[] = Order::whereIn('status', [
                    'Completed',
                    'Delivered'
                ])
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->sum('total_price');
        }

        /*
        |--------------------------------------------------------------------------
        | Order Status Count
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::where('status', 'Pending')->count();

        $acceptedOrders = Order::where('status', 'Accepted')->count();

        $preparingOrders = Order::where('status', 'Preparing')->count();

        $readyOrders = Order::where('status', 'Ready')->count();

        $completedOrders = Order::whereIn('status', [
            'Completed',
            'Delivered'
        ])->count();

        $cancelledOrders = Order::whereIn('status', [
            'Rejected',
            'Cancelled'
        ])->count();

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
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Low Stock
        |--------------------------------------------------------------------------
        */

        $lowStock = Inventory::with('medicine')
            ->where('stock', '<=', 20)
            ->where('stock', '>', 0)
            ->orderBy('stock')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Latest Pharmacies
        |--------------------------------------------------------------------------
        */

        $latestPharmacies = Pharmacy::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(

            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'totalPharmacies',
            'totalPatients',

            'totalRevenue',
            'monthlyRevenue',

            'pendingOrders',
            'acceptedOrders',
            'preparingOrders',
            'readyOrders',
            'completedOrders',
            'cancelledOrders',

            'recentOrders',
            'lowStock',
            'latestPharmacies'

        ));
    }
}