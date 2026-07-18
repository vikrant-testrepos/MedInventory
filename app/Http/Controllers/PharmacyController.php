<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::latest()->paginate(10);

        return view('pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('pharmacies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'owner_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'district' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->owner_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pharmacy',
        ]);

        Pharmacy::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'owner_name' => $request->owner_name,
            'license_number' => $request->license_number,
            'phone' => $request->phone,
            'email' => $request->email,
            'district' => $request->district,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'approved' => true,
        ]);

        return redirect()
            ->route('pharmacies.index')
            ->with('success', 'Pharmacy added successfully.');
    }

    public function edit($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        return view('pharmacies.edit', compact('pharmacy'));
    }

    public function update(Request $request, $id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $pharmacy->update($request->all());

        return redirect()
            ->route('pharmacies.index')
            ->with('success', 'Pharmacy updated successfully.');
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);

        $pharmacy->delete();

        return back()->with('success', 'Pharmacy deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'approved' => 'required|boolean',
        ]);

        $pharmacy = Pharmacy::findOrFail($id);

        $pharmacy->approved = $request->approved;

        $pharmacy->save();

        return redirect()
            ->back()
            ->with('success', 'Pharmacy status updated successfully.');
    }
}