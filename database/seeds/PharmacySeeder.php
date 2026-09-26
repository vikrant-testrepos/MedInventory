<?php

use Illuminate\Database\Seeder;
use App\Pharmacy;
use App\User;
use Illuminate\Support\Facades\Hash;

class PharmacySeeder extends Seeder
{
    public function run()
    {
        $pharmacies = [
            ['Sagarmatha Pharmacy', 'Ram Thapa', 'Kathmandu', 'New Baneshwor'],
            ['Himalayan Health Pharmacy', 'Sita Sharma', 'Lalitpur', 'Jawalakhel'],
            ['Nepal Medicare', 'Bikash Karki', 'Bhaktapur', 'Suryabinayak'],
            ['Fewa City Pharmacy', 'Prakash Gurung', 'Kaski', 'Lakeside, Pokhara'],
            ['Chitwan Community Pharmacy', 'Manoj Thapa', 'Chitwan', 'Bharatpur'],
            ['Koshi Health Point', 'Niruta Rai', 'Morang', 'Biratnagar'],
            ['Lumbini Medicine Centre', 'Bibek Bhandari', 'Rupandehi', 'Butwal'],
            ['Karnali Care Pharmacy', 'Sarita Shahi', 'Surkhet', 'Birendranagar'],
            ['Janakpur Janaushadhi', 'Amit Yadav', 'Dhanusha', 'Janakpur'],
            ['Dhaulagiri Pharmacy', 'Rachana Pun', 'Baglung', 'Baglung Bazaar'],
        ];

        foreach ($pharmacies as $index => $data) {
            $email = 'pharmacy' . ($index + 1) . '@medinventory.np';
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $data[0],
                    'password' => Hash::make('Pharmacy@123'),
                    'role' => 'pharmacy',
                ]
            );

            Pharmacy::updateOrCreate(
                ['email' => $email],
                [
                    'user_id' => $user->id,
                    'name' => $data[0],
                    'owner_name' => $data[1],
                    'license_number' => 'NP-PH-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'phone' => '98' . str_pad(10000000 + $index, 8, '0', STR_PAD_LEFT),
                    'district' => $data[2],
                    'address' => $data[3],
                    'approved' => true,
                ]
            );
        }
    }
}
