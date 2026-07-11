<?php

namespace App\Http\Controllers;

use App\Medicine;

class HomeController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->take(6)->get();

        return view('home', compact('medicines'));
    }
}