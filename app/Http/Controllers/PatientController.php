<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Order;
use App\Pharmacy;
use App\Category;

class PatientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Patient Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $medicines = Medicine::with([
                'category',
                'pharmacy'
            ])
            ->where('quantity', '>', 0)
            ->latest()
            ->get();

        $categories = Category::latest()->get();

        $pharmacies = Pharmacy::latest()->get();

        return view('home', compact(
            'medicines',
            'categories',
            'pharmacies'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Medicine Details
    |--------------------------------------------------------------------------
    */

    public function showMedicine(Medicine $medicine)
    {
        $medicine->load([
            'category',
            'pharmacy'
        ]);

        $relatedMedicines = Medicine::where(
                'category_id',
                $medicine->category_id
            )
            ->where('id', '!=', $medicine->id)
            ->where('quantity', '>', 0)
            ->take(4)
            ->get();

        return view(
            'patient.medicine-details',
            compact(
                'medicine',
                'relatedMedicines'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Patient Orders
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        $orders = Order::with('medicine')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'patient.orders',
            compact('orders')
        );
    }
}