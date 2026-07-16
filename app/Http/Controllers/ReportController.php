<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use App\Order;

class ReportController extends Controller
{
    public function index()
    {
        $totalMedicines = Medicine::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $lowStock = Medicine::where('quantity', '<=', 10)->count();
        $outOfStock = Medicine::where('quantity', 0)->count();

        return view('reports.index', compact(
            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'lowStock',
            'outOfStock'
        ));
    }
}