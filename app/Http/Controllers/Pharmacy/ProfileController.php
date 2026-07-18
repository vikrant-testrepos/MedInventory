<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show profile page.
     */
    public function index()
    {
        $user = Auth::user();
        $pharmacy = $user->pharmacy;

        return view('pharmacy.profile.index', compact('user', 'pharmacy'));
    }

    /**
     * Update account information.
     */
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Account updated successfully.');
    }

    /**
     * Update pharmacy information.
     */
    public function updatePharmacy(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'owner_name'      => 'required|string|max:255',
            'license_number'  => 'required|string|max:255',
            'phone'           => 'required|string|max:20',
            'email'           => 'nullable|email|max:255',
            'district'        => 'required|string|max:255',
            'address'         => 'required|string',
            'opening_time'    => 'nullable',
            'closing_time'    => 'nullable',

            // NEW
            'latitude'        => 'nullable|numeric',
            'longitude'       => 'nullable|numeric',

            'logo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pharmacy = Auth::user()->pharmacy;

        $pharmacy->name = $request->name;
        $pharmacy->owner_name = $request->owner_name;
        $pharmacy->license_number = $request->license_number;
        $pharmacy->phone = $request->phone;
        $pharmacy->email = $request->email;
        $pharmacy->district = $request->district;
        $pharmacy->address = $request->address;
        $pharmacy->opening_time = $request->opening_time;
        $pharmacy->closing_time = $request->closing_time;

        // NEW
        $pharmacy->latitude = $request->latitude;
        $pharmacy->longitude = $request->longitude;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('pharmacies', 'public');
            $pharmacy->logo = $logo;
        }

        $pharmacy->save();

        return redirect()
            ->back()
            ->with('success', 'Pharmacy information updated successfully.');
    }
}