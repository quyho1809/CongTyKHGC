<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class AdminUserSeeder extends Seeder
{
   
    public function run(): void
    {
        User::insert([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'superadmin@khgc.com',
            'password' => Hash::make('Abcd@1234'),
            'status' => 1,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),

            
        ],
        [
            'first_name' => 'Quy',
            'last_name' => 'Ho',
            'email' => 'quyho180919@gmail.com',
            'password' => Hash::make('banhcanh21A'),
            'status' => 1,
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
    }
}
