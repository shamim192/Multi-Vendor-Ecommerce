<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
             'name' => 'Admin user',
             'username' => 'adminuser',
             'email' => 'admin@gmail.com',
             'role' => 'admin',
             'status' => 'active',
             'password' => bcrypt('12345678'),
        ]);

        User::create([
             'name' => 'Vendor user',
             'username' => 'vendoruser',
             'email' => 'vendor@gmail.com',
             'role' => 'vendor',
             'status' => 'active',
             'password' => bcrypt('12345678'),
        ]);
        
        User::create([
             'name' => 'user',
             'username' => 'useruser',
             'email' => 'user@gmail.com',
             'role' => 'user',
             'status' => 'active',
             'password' => bcrypt('12345678'),
        ]);
    }
}
