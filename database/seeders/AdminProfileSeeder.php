<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $user = User::where('email', 'admin@gmail.com')->first();

        $vendor = new Vendor();

        $vendor->user_id = $user->id;
        $vendor->banner = 'uploads/123.jpeg';
        $vendor->phone = '1234567890';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'Plovdiv, Bulgaria';
        $vendor->description = 'This is a test description';

        $vendor->save();
    }
}
