<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Medicine;
use App\Category;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function index()
    {
        $pharmacy = Pharmacy::where('user_id', Auth::id())->first();

        $medicines = Medicine::with('category')
            ->where('pharmacy_id', $pharmacy->id)
            ->latest()
            ->paginate(10);

        return view(
            'pharmacy.medicines.index',
            compact('medicines')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'pharmacy.medicines.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'company' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        $pharmacy = Pharmacy::where('user_id', Auth::id())->first();

        $medicine = new Medicine();

        $medicine->pharmacy_id = $pharmacy->id;
        $medicine->category_id = $request->category_id;
        $medicine->name = $request->name;
        $medicine->company = $request->company;
        $medicine->price = $request->price;
        $medicine->quantity = $request->quantity;
        $medicine->description = $request->description;

        if ($request->hasFile('image')) {

            $image = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/medicines'),
                $image
            );

            $medicine->image = $image;
        }

        $medicine->save();

        return redirect()
            ->route('pharmacy.medicines.index')
            ->with('success', 'Medicine added successfully.');
    }

    public function edit(Medicine $medicine)
    {
        $this->authorizeOwnership($medicine);

        $categories = Category::orderBy('name')->get();

        return view(
            'pharmacy.medicines.edit',
            compact('medicine', 'categories')
        );
    }

    public function update(Request $request, Medicine $medicine)
    {
        $this->authorizeOwnership($medicine);

        $request->validate([

            'category_id' => 'required|exists:categories,id',

            'name' => 'required|string|max:255',

            'company' => 'required|string|max:255',

            'price' => 'required|numeric',

            'quantity' => 'required|integer',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $data = $request->only([

            'category_id',

            'name',

            'company',

            'price',

            'quantity',

            'description',

        ]);

        if ($request->hasFile('image')) {

            // Delete old image
            if (
                $medicine->image &&
                file_exists(public_path('uploads/medicines/' . $medicine->image))
            ) {

                unlink(public_path('uploads/medicines/' . $medicine->image));

            }

            // Upload new image
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/medicines'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        $medicine->update($data);

        return redirect()
            ->route('pharmacy.medicines.index')
            ->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $this->authorizeOwnership($medicine);

        if (
            $medicine->image &&
            file_exists(public_path('uploads/medicines/' . $medicine->image))
        ) {

            unlink(public_path('uploads/medicines/' . $medicine->image));

        }

        $medicine->delete();

        return redirect()
            ->route('pharmacy.medicines.index')
            ->with('success', 'Medicine deleted successfully.');
    }

    /**
     * Ensure the authenticated pharmacy owns the given medicine.
     */
    protected function authorizeOwnership(Medicine $medicine)
    {
        $pharmacyId = Auth::user()->pharmacy->id ?? null;

        if (! $pharmacyId || $medicine->pharmacy_id != $pharmacyId) {
            abort(403);
        }
    }
    
}
