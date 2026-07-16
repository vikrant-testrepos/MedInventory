<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Pharmacy;

class PatientController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category', 'pharmacy')
            ->where('quantity', '>', 0)
            ->latest()
            ->get();

        $pharmacies = Pharmacy::latest()->get();

        return view('home', compact(
            'medicines',
            'pharmacies'
        ));
    }
}