<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use App\Order;

class AdminController extends Controller
{
    public function index()
    {
        $medicineCount = Medicine::count();

        $categoryCount = Category::count();

        $orderCount = Order::count();

        $lowStock = Medicine::where('quantity', '<=', 20)->count();

        return view('admin.dashboard', compact(
            'medicineCount',
            'categoryCount',
            'orderCount',
            'lowStock'
        ));
    }
}