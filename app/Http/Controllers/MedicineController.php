<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')->latest()->paginate(10);

        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/medicines'),
                $imageName
            );
        }

        Medicine::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'company' => $request->company,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);

        $categories = Category::all();

        return view('medicines.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'company' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable'
        ]);

        $medicine = Medicine::findOrFail($id);

        $medicine->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'company'     => $request->company,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()
                ->route('medicines.index')
                ->with('success', 'Medicine updated successfully.');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);

        if ($medicine->image && file_exists(public_path('uploads/medicines/' . $medicine->image))) {
            unlink(public_path('uploads/medicines/' . $medicine->image));
        }

        $medicine->delete();

        return redirect()->route('medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }
}