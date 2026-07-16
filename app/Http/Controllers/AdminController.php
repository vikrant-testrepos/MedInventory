<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use App\Order;

class AdminController extends Controller
{
    public function index()
    {
        $totalMedicines = \App\Medicine::count();
        $totalCategories = \App\Category::count();
        $totalOrders = \App\Order::count();
        $totalPharmacies = \App\Pharmacy::count();

        $lowStock = \App\Medicine::where('quantity', '<=', 10)
                        ->orderBy('quantity')
                        ->take(5)
                        ->get();

        $recentOrders = \App\Order::with('medicine', 'user')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact(
            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'totalPharmacies',
            'lowStock',
            'recentOrders'
        ));
    }
}