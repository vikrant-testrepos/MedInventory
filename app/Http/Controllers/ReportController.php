<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;
use App\Pharmacy;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    private function getReportData()
    {
        $totalMedicines = Medicine::count();

        $totalCategories = Category::count();

        $totalOrders = Order::count();

        $totalPatients = User::where('role', 'patient')->count();

        $totalPharmacies = Pharmacy::count();

        $totalRevenue = Order::whereIn('status', [
            'Completed',
            'Delivered'
        ])->sum('total_price');

        $inventoryCost = Medicine::sum(\DB::raw('cost_price * quantity'));

        $inventorySellingValue = Medicine::sum(\DB::raw('price * quantity'));

        $expectedProfit = $inventorySellingValue - $inventoryCost;

        $totalStock = Medicine::sum('quantity');

        $lowStock = Medicine::where('quantity', '<=', 10)
            ->where('quantity', '>', 0)
            ->count();

        $outOfStock = Medicine::where('quantity', 0)->count();

        $topMedicines = Medicine::withCount('orders')
            ->orderByDesc('orders_count')
            ->take(10)
            ->get();

        $expiringMedicines = Medicine::whereNotNull('expiry_date')
            ->orderBy('expiry_date')
            ->take(10)
            ->get();

        $lowStockMedicines = Medicine::where('quantity', '<=', 10)
            ->orderBy('quantity')
            ->get();

        $recentOrders = Order::with([
            'user',
            'medicine',
            'pharmacy'
        ])
        ->latest()
        ->take(10)
        ->get();

        return compact(
            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'totalPatients',
            'totalPharmacies',
            'totalRevenue',
            'inventoryCost',
            'inventorySellingValue',
            'expectedProfit',
            'totalStock',
            'lowStock',
            'outOfStock',
            'topMedicines',
            'expiringMedicines',
            'lowStockMedicines',
            'recentOrders'
        );
    }

    public function index()
    {
        return view(
            'reports.index',
            $this->getReportData()
        );
    }

    public function print()
    {
        $data = $this->getReportData();

        $data['medicines'] = Medicine::with('category')
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView(
            'pdf.report',
            $data
        );

        $pdf->setPaper('a4','portrait');

        return $pdf->download(
            'MedInventory_Business_Report.pdf'
        );
    }
}