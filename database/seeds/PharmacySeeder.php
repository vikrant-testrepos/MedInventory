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
            [
                'name' => 'Apollo Pharmacy',
                'owner_name' => 'Ram Sharma',
                'license_number' => 'LIC1001',
                'phone' => '9800000001',
                'email' => 'apollo@example.com',
                'district' => 'Kathmandu',
                'address' => 'New Road, Kathmandu',
            ],
            [
                'name' => 'City Medicos',
                'owner_name' => 'Sita Karki',
                'license_number' => 'LIC1002',
                'phone' => '9800000002',
                'email' => 'city@example.com',
                'district' => 'Lalitpur',
                'address' => 'Jawalakhel, Lalitpur',
            ],
            [
                'name' => 'HealthCare Plus',
                'owner_name' => 'Hari Nepal',
                'license_number' => 'LIC1003',
                'phone' => '9800000003',
                'email' => 'health@example.com',
                'district' => 'Bhaktapur',
                'address' => 'Suryabinayak',
            ],
            [
                'name' => 'MedLife Pharmacy',
                'owner_name' => 'Gita Rai',
                'license_number' => 'LIC1004',
                'phone' => '9800000004',
                'email' => 'medlife@example.com',
                'district' => 'Pokhara',
                'address' => 'Lakeside',
            ],
            [
                'name' => 'Nepal Pharmacy',
                'owner_name' => 'Krishna Thapa',
                'license_number' => 'LIC1005',
                'phone' => '9800000005',
                'email' => 'nepal@example.com',
                'district' => 'Chitwan',
                'address' => 'Bharatpur',
            ]
        ];

        foreach ($pharmacies as $data) {

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'pharmacy'
                ]
            );

            Pharmacy::firstOrCreate(
                ['email' => $data['email']],
                [
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'owner_name' => $data['owner_name'],
                    'license_number' => $data['license_number'],
                    'phone' => $data['phone'],
                    'district' => $data['district'],
                    'address' => $data['address'],
                ]
            );
        }
    }
}