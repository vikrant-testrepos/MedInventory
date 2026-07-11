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
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }
}