<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Inventory;
use App\Medicine;
use App\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('medicine')
            ->whereHas('medicine', function ($query) {

                $query->where(
                    'pharmacy_id',
                    Auth::user()->pharmacy->id
                );

            })
            ->latest()
            ->paginate(10);

        return view(
            'pharmacy.inventory.index',
            compact('inventories')
        );
    }

    public function create()
    {
        $medicines = Medicine::where(
            'pharmacy_id',
            Auth::user()->pharmacy->id
        )
        ->orderBy('name')
        ->get();

        return view(
            'pharmacy.inventory.create',
            compact('medicines')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'medicine_id' => 'required|exists:medicines,id',

            'batch_no' => 'required|string|max:255',

            'supplier' => 'nullable|string|max:255',

            'stock' => 'required|integer|min:1',

            'purchase_price' => 'required|numeric',

            'selling_price' => 'required|numeric',

            'expiry_date' => 'required|date',

        ]);

        $pharmacyId = Auth::user()->pharmacy->id ?? null;

        $medicine = Medicine::where('pharmacy_id', $pharmacyId)
            ->findOrFail($request->medicine_id);

        $inventory = Inventory::create([

            'medicine_id'     => $medicine->id,

            'batch_no'        => $request->batch_no,

            'supplier'        => $request->supplier,

            'stock'           => $request->stock,

            'purchase_price'  => $request->purchase_price,

            'selling_price'   => $request->selling_price,

            'expiry_date'     => $request->expiry_date,

        ]);

        $before = $medicine->quantity;

        $medicine->quantity += $request->stock;

        $medicine->price = $request->selling_price;

        $medicine->save();

        StockHistory::create([

            'medicine_id'   => $medicine->id,

            'inventory_id'  => $inventory->id,

            'user_id'       => Auth::id(),

            'action'        => 'Stock Added',

            'quantity'      => $request->stock,

            'stock_before'  => $before,

            'stock_after'   => $medicine->quantity,

            'remarks'       => 'Inventory added by pharmacy.',

        ]);

        return redirect()
            ->route('pharmacy.inventory.index')
            ->with('success', 'Inventory added successfully.');
    }

    public function show(Inventory $inventory)
    {
        //
    }

    public function edit(Inventory $inventory)
    {
        if (
            $inventory->medicine->pharmacy_id !=
            Auth::user()->pharmacy->id
        ) {

            abort(403);

        }

        return view(
            'pharmacy.inventory.edit',
            compact('inventory')
        );
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([

            'batch_no' => 'required',

            'supplier' => 'nullable',

            'stock' => 'required|integer|min:0',

            'purchase_price' => 'required|numeric',

            'selling_price' => 'required|numeric',

            'expiry_date' => 'required|date',

        ]);

        $medicine = $inventory->medicine;

        $oldStock = $inventory->stock;

        $difference = $request->stock - $oldStock;

        $inventory->update([

            'batch_no' => $request->batch_no,

            'supplier' => $request->supplier,

            'stock' => $request->stock,

            'purchase_price' => $request->purchase_price,

            'selling_price' => $request->selling_price,

            'expiry_date' => $request->expiry_date,

        ]);

        $before = $medicine->quantity;

        $medicine->quantity += $difference;

        $medicine->price = $request->selling_price;

        $medicine->save();

        StockHistory::create([

            'medicine_id' => $medicine->id,

            'inventory_id' => $inventory->id,

            'user_id' => Auth::id(),

            'action' => 'Stock Updated',

            'quantity' => abs($difference),

            'stock_before' => $before,

            'stock_after' => $medicine->quantity,

            'remarks' => 'Inventory updated by pharmacy.',

        ]);

        return redirect()
            ->route('pharmacy.inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        if (
            $inventory->medicine->pharmacy_id !=
            Auth::user()->pharmacy->id
        ) {

            abort(403);

        }

        $medicine = $inventory->medicine;

        $before = $medicine->quantity;

        $medicine->quantity -= $inventory->stock;

        if ($medicine->quantity < 0) {

            $medicine->quantity = 0;

        }

        $medicine->save();

        StockHistory::create([

            'medicine_id' => $medicine->id,

            'inventory_id' => $inventory->id,

            'user_id' => Auth::id(),

            'action' => 'Stock Deleted',

            'quantity' => $inventory->stock,

            'stock_before' => $before,

            'stock_after' => $medicine->quantity,

            'remarks' => 'Inventory deleted by pharmacy.',

        ]);

        $inventory->delete();

        return redirect()
            ->route('pharmacy.inventory.index')
            ->with('success', 'Inventory deleted successfully.');
    }
}
