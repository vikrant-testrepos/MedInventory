<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;

class ReportController extends Controller
{
    public function index()
    {
        $totalMedicines = Medicine::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();

        $totalStock = Medicine::sum('quantity');

        $lowStock = Medicine::where('quantity', '<=', 10)
                            ->where('quantity', '>', 0)
                            ->count();

        $outOfStock = Medicine::where('quantity', 0)->count();

        $inventoryValue = Medicine::selectRaw('SUM(price * quantity) as total')
                                  ->value('total');

        $lowStockMedicines = Medicine::where('quantity', '<=', 10)
                                     ->orderBy('quantity')
                                     ->get();

        $recentOrders = Order::with('medicine', 'user')
                             ->latest()
                             ->take(5)
                             ->get();

        return view('reports.index', compact(
            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'totalStock',
            'lowStock',
            'outOfStock',
            'inventoryValue',
            'lowStockMedicines',
            'recentOrders'
        ));
    }
}