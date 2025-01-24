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
            'email' => 'receptionist2@gmail.com',
            'phone_number' => '772221242',
            'role' => 'receptioniste',
            'password' => Hash::make('Passd123'),
        ]);
    }
}
