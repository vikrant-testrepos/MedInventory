<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $pharmacy = Auth::user()->pharmacy;

        $orders = Order::with(['user', 'medicine'])
            ->where('pharmacy_id', $pharmacy->id)
            ->latest()
            ->get();

        $totalOrders = $orders->count();

        $pendingOrders = $orders->where('status', 'Pending')->count();

        $completedOrders = $orders->where('status', 'Completed')->count();

        $totalRevenue = $orders
            ->where('status', 'Completed')
            ->sum('total_price');

        return view('pharmacy.reports.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue'
        ));
    }
}