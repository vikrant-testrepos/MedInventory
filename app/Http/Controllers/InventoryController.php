<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $medicines = Medicine::orderBy('name')->paginate(10);

        return view('inventory.index', compact('medicines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $medicine = Medicine::findOrFail($id);

        $medicine->quantity = $request->quantity;

        $medicine->save();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Stock updated successfully.');
    }
}