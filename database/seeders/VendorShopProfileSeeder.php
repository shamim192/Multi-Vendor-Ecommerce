<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','vendor@gmail.com')->first();

        Vendor::create([
            'banner' => 'uploads/123.jpg',
            'shop_name' => 'vendor shop',
            'phone' => '0175835570',
            'email' => 'vendor@gmail.com',
            'address' => 'Usa',
            'description' => 'shop description',
            'user_id' => $user->id,
        ]);
    }
}
