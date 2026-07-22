<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use App\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    private function getReportData()
    {
        $totalMedicines = Medicine::count();

        $totalCategories = Category::count();

        $totalOrders = Order::count();

        $totalStock = Medicine::sum('quantity');

        $lowStock = Medicine::where('quantity','<=',10)
            ->where('quantity','>',0)
            ->count();

        $outOfStock = Medicine::where('quantity',0)
            ->count();

        $inventoryValue = Medicine::selectRaw(
            'SUM(price * quantity) as total'
        )->value('total');

        $lowStockMedicines = Medicine::where('quantity','<=',10)
            ->orderBy('quantity')
            ->get();

        $recentOrders = Order::with(
                'medicine',
                'user'
            )
            ->latest()
            ->take(10)
            ->get();

        return compact(
            'totalMedicines',
            'totalCategories',
            'totalOrders',
            'totalStock',
            'lowStock',
            'outOfStock',
            'inventoryValue',
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

        $pdf->setPaper(
            'a4',
            'portrait'
        );

        return $pdf->download(
            'Medicine_Report.pdf'
        );
    }
}