<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;
use App\Pharmacy;
use App\Inventory;

class AdminController extends Controller
{
    public function index()
    {
        $recentOrders = Order::with(
            'user',
            'medicine',
            'pharmacy'
        )
        ->latest()
        ->take(5)
        ->get();

        $lowStock = Inventory::with('medicine')
            ->where('stock', '<=', 20)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $latestPharmacies = Pharmacy::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [

            'totalMedicines'  => Medicine::count(),

            'totalCategories' => Category::count(),

            'totalOrders'     => Order::count(),

            'totalPharmacies' => Pharmacy::count(),

            'recentOrders'    => $recentOrders,

            'lowStock'        => $lowStock,

            'latestPharmacies'=> $latestPharmacies,

        ]);
    }
}