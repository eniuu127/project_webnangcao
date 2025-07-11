<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        //$this->call(AdminUserSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@shop.com',
            'password' => Hash::make('123'),
            'is_admin' => true,
        ]);
    }
}
