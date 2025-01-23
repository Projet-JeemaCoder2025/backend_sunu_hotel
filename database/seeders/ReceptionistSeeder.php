<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Receptionist',
            'last_name' => 'User',
            'email' => 'receptionist@example.com',
            'phone_number' => '770000000',
            'role' => 'receptionist',
            'password' => Hash::make('password'),
        ]);
    }
}
