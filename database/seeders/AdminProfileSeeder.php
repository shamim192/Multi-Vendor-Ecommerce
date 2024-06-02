<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::where('email','admin@gmail.com')->first();

        Vendor::create([
            'banner' => 'uploads/123.jpg',
            'phone' => '0175835570',
            'email' => 'admin@gmail.com',
            'address' => 'Usa',
            'description' => 'shop description',
            'user_id' => $user->id,
        ]);
    }
}
