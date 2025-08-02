<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CaissierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'caissier@example.com'],
            [
                'name' => 'caissier',
                'password' => Hash::make('1234'),
                'role' => 'caissier',
            ]
        );
    }
}
