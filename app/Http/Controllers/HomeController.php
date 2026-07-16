<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Redirect admin to admin dashboard
        if (Auth::user()->role == 'admin') {
            return redirect('/admin');
        }

        // Patient dashboard
        $medicines = Medicine::latest()->take(6)->get();

        return view('home', compact('medicines'));
    }
}