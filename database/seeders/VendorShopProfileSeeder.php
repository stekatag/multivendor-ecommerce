<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorShopProfileSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor = new Vendor();

        $vendor->user_id = $user->id;
        $vendor->banner = 'uploads/123.jpeg';
        $vendor->shop_name = 'Vendor Shop';
        $vendor->phone = '1234567890';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Plovdiv, Bulgaria';
        $vendor->description = 'This is a test description';

        $vendor->save();
    }
}
