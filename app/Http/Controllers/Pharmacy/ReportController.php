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

        $acceptedOrders = $orders->where('status', 'Accepted')->count();

        $preparingOrders = $orders->where('status', 'Preparing')->count();

        $readyOrders = $orders->where('status', 'Ready')->count();

        $completedOrders = $orders->where('status', 'Completed')->count();

        $rejectedOrders = $orders->where('status', 'Rejected')->count();

        $totalRevenue = $orders
            ->where('status', 'Completed')
            ->sum('total_price');

        return view('pharmacy.reports.index', compact(
            'pharmacy',
            'orders',
            'totalOrders',
            'pendingOrders',
            'acceptedOrders',
            'preparingOrders',
            'readyOrders',
            'completedOrders',
            'rejectedOrders',
            'totalRevenue'
        ));
    }

    public function print()
    {
        $pharmacy = Auth::user()->pharmacy;

        $orders = Order::with(['user', 'medicine'])
            ->where('pharmacy_id', $pharmacy->id)
            ->latest()
            ->get();

        $totalOrders = $orders->count();

        $pendingOrders = $orders->where('status', 'Pending')->count();

        $acceptedOrders = $orders->where('status', 'Accepted')->count();

        $preparingOrders = $orders->where('status', 'Preparing')->count();

        $readyOrders = $orders->where('status', 'Ready')->count();

        $completedOrders = $orders->where('status', 'Completed')->count();

        $rejectedOrders = $orders->where('status', 'Rejected')->count();

        $totalRevenue = $orders
            ->where('status', 'Completed')
            ->sum('total_price');

        return view('pharmacy.reports.print', compact(
            'pharmacy',
            'orders',
            'totalOrders',
            'pendingOrders',
            'acceptedOrders',
            'preparingOrders',
            'readyOrders',
            'completedOrders',
            'rejectedOrders',
            'totalRevenue'
        ));
    }
}