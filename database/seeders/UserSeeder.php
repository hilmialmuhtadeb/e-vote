<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hilmi Al Muhtade',
            'ktp_number' => '3578303006010001',
            'kta_number' => '1202210',
            'phone_number' => '089601628845',
            'status' => 'active',
        ]);
    }
}
