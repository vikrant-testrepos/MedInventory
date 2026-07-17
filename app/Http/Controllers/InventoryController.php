<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Medicine;
use App\StockHistory;
use Illuminate\Http\Request;

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

            'user_id'      => auth()->id(),

            'action'       => 'Stock Added',

            'quantity'     => $inventory->stock,

            'stock_before' => 0,

            'stock_after'  => $inventory->stock,

            'remarks'      => 'New inventory stock added.'

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

        $stockBefore = $inventory->stock;

        $inventory->update($request->all());

        StockHistory::create([

            'medicine_id'  => $inventory->medicine_id,

            'inventory_id' => $inventory->id,

            'user_id'      => auth()->id(),

            'action'       => 'Stock Updated',

            'quantity'     => abs($inventory->stock - $stockBefore),

            'stock_before' => $stockBefore,

            'stock_after'  => $inventory->stock,

            'remarks'      => 'Inventory updated by admin.'

        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        StockHistory::create([

            'medicine_id'  => $inventory->medicine_id,

            'inventory_id' => $inventory->id,

            'user_id'      => auth()->id(),

            'action'       => 'Stock Deleted',

            'quantity'     => $inventory->stock,

            'stock_before' => $inventory->stock,

            'stock_after'  => 0,

            'remarks'      => 'Inventory record deleted.'

        ]);

        $inventory->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory deleted successfully.');
    }
}