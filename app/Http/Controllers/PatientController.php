<?php

namespace App\Http\Controllers;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.dashboard');
    }
}