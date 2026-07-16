<?php

namespace App\Http\Controllers;

use App\Medicine;

class WelcomeController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->take(6)->get();

        return view('welcome', compact('medicines'));
    }
}