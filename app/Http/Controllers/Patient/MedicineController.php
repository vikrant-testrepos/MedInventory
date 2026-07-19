<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Medicine;

class MedicineController extends Controller
{
    public function show($id)
    {
        $medicine = Medicine::with([
            'category',
            'pharmacy'
        ])->findOrFail($id);

        return view(
            'patient.medicine.show',
            compact('medicine')
        );
    }
}