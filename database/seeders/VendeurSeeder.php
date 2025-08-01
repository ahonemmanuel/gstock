<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'vendeur@example.com'],
            [
                'name' => 'vendeur',
                'password' => Hash::make('1234'),
                'role' => 'vendeur',
            ]
        );
    }
}
