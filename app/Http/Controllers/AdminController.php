<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;
use App\Pharmacy;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            'totalMedicines'  => Medicine::count(),

            'totalCategories' => Category::count(),

            'totalOrders'     => Order::count(),

            'totalPharmacies' => Pharmacy::count(),

            'recentOrders' => Order::with(
                'user',
                'medicine',
                'pharmacy'
            )->latest()->take(5)->get(),

            'lowStock' => Medicine::where('quantity','<',10)
                            ->orderBy('quantity')
                            ->take(5)
                            ->get(),

            'latestPharmacies' => Pharmacy::latest()
                                    ->take(5)
                                    ->get()

        ]);
    }
}