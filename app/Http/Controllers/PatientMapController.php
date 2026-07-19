<?php

namespace App\Http\Controllers;

use App\Medicine;

class PatientMapController extends Controller
{
    public function index(Medicine $medicine)
    {
        $medicine->load('pharmacy');

        return view(
            'patient.map',
            compact('medicine')
        );
    }
}