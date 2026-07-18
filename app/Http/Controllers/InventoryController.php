<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Medicine;
use App\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $search = request('search');

        $inventories = Inventory::with('medicine')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('medicine', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        $totalMedicines = Inventory::count();

        $lowStock = Inventory::where('stock', '<=', 20)
            ->where('stock', '>', 0)
            ->count();

        $outOfStock = Inventory::where('stock', 0)->count();

        $expiringSoon = Inventory::whereDate(
                'expiry_date',
                '<=',
                now()->addDays(30)
            )
            ->whereDate(
                'expiry_date',
                '>=',
                now()
            )
            ->count();

        return view(
            'inventory.index',
            compact(
                'inventories',
                'totalMedicines',
                'lowStock',
                'outOfStock',
                'expiringSoon'
            )
        );
    }

    public function create()
    {
        $medicines = Medicine::orderBy('name')->get();

        return view('inventory.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required',
            'batch_no' => 'required',
            'supplier' => 'required',
            'stock' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);

        $inventory = Inventory::create($request->all());

        StockHistory::create([
            'medicine_id'  => $inventory->medicine_id,
            'inventory_id' => $inventory->id,
            'user_id'      => Auth::id(),
            'action'       => 'Stock Added',
            'quantity'     => $inventory->stock,
            'stock_before' => 0,
            'stock_after'  => $inventory->stock,
            'remarks'      => 'New inventory added',
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory added successfully.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);

        $medicines = Medicine::orderBy('name')->get();

        return view('inventory.edit', compact(
            'inventory',
            'medicines'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_id' => 'required',
            'batch_no' => 'required',
            'supplier' => 'required',
            'stock' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);

        $inventory = Inventory::findOrFail($id);

        $beforeStock = $inventory->stock;

        $inventory->update($request->all());

        StockHistory::create([
            'medicine_id'  => $inventory->medicine_id,
            'inventory_id' => $inventory->id,
            'user_id'      => Auth::id(),
            'action'       => 'Stock Updated',
            'quantity'     => $inventory->stock - $beforeStock,
            'stock_before' => $beforeStock,
            'stock_after'  => $inventory->stock,
            'remarks'      => 'Inventory updated',
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        Inventory::destroy($id);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory deleted successfully.');
    }
}