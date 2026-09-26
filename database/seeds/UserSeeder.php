<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin Ram Thapa',
                'email' => 'admin@medinventory.np',
                'role' => 'admin',
                'password' => 'Admin@123',
            ],
            [
                'name' => 'Sita Sharma',
                'email' => 'patient@medinventory.np',
                'role' => 'patient',
                'password' => 'Patient@123',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'role' => $data['role'],
                    'password' => Hash::make($data['password']),
                ]
            );
        }
    }
}
