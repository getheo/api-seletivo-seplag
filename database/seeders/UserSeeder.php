<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('id', 1)->first()) {
            User::create([                
                'name' => "Seplag",
                'email' => 'teste@seplag.mt.gov.br',
                'password' => Hash::make('seplag2025'),
            ]);
        }
    }
}
