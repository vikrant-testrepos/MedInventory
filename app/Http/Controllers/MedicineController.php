<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')
            ->latest()
            ->paginate(10);

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

            'cost_price' => 'required|numeric',

            'quantity' => 'required|numeric',

            'batch_number' => 'nullable|string|max:100',

            'expiry_date' => 'nullable|date',

            'image' => 'nullable|image'

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

            'cost_price' => $request->cost_price,

            'quantity' => $request->quantity,

            'batch_number' => $request->batch_number,

            'expiry_date' => $request->expiry_date,

            'description' => $request->description,

            'image' => $imageName,

        ]);

        return redirect()

            ->route('medicines.index')

            ->with('success','Medicine added successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);

        $categories = Category::all();

        return view('medicines.edit', compact(

            'medicine',

            'categories'

        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',

            'category_id' => 'required',

            'price' => 'required|numeric',

            'cost_price' => 'required|numeric',

            'quantity' => 'required|numeric',

            'batch_number' => 'nullable|string|max:100',

            'expiry_date' => 'nullable|date',

            'image' => 'nullable|image'

        ]);

        $medicine = Medicine::findOrFail($id);

        $imageName = $medicine->image;

        if ($request->hasFile('image')) {

            if (

                $medicine->image &&

                file_exists(

                    public_path(

                        'uploads/medicines/'.$medicine->image

                    )

                )

            ) {

                unlink(

                    public_path(

                        'uploads/medicines/'.$medicine->image

                    )

                );

            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(

                public_path('uploads/medicines'),

                $imageName

            );

        }

        $medicine->update([

            'category_id' => $request->category_id,

            'name' => $request->name,

            'company' => $request->company,

            'price' => $request->price,

            'cost_price' => $request->cost_price,

            'quantity' => $request->quantity,

            'batch_number' => $request->batch_number,

            'expiry_date' => $request->expiry_date,

            'description' => $request->description,

            'image' => $imageName

        ]);

        return redirect()

            ->route('medicines.index')

            ->with('success','Medicine updated successfully.');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);

        if (

            $medicine->image &&

            file_exists(

                public_path(

                    'uploads/medicines/'.$medicine->image

                )

            )

        ) {

            unlink(

                public_path(

                    'uploads/medicines/'.$medicine->image

                )

            );

        }

        $medicine->delete();

        return redirect()

            ->route('medicines.index')

            ->with('success','Medicine deleted successfully.');
    }
}