<?php

namespace App\Http\Controllers;

class PharmacyDashboardController extends Controller
{
    public function index()
    {
        return view('pharmacy.dashboard');
    }
}