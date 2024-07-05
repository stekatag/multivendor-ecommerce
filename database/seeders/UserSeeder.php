<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin user',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'status' => 'active',
                    'password' => bcrypt('123'),
                ],
                [
                    'name' => 'Vendor user',
                    'username' => 'vendor',
                    'email' => 'vendor@gmail.com',
                    'role' => 'vendor',
                    'status' => 'active',
                    'password' => bcrypt('123'),
                ],
                [
                    'name' => 'user',
                    'username' => 'user',
                    'email' => 'user@gmail.com',
                    'role' => 'user',
                    'status' => 'active',
                    'password' => bcrypt('123'),
                ],
            ]
        );
    }
}
