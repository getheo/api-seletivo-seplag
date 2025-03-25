<?php

namespace Database\Seeders;

use App\Models\ServidorTemporario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServidorTemporarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!ServidorTemporario::where('pes_id', 4)->first()) {
            ServidorTemporario::create([
                'pes_id' => 4,
                'st_data_admissao' => '2025-01-01',
                'st_data_demissao' => NULL,
            ]);
        }

        if (!ServidorTemporario::where('pes_id', 5)->first()) {
            ServidorTemporario::create([
                'pes_id' => 5,
                'st_data_admissao' => '2023-02-10',
                'st_data_demissao' => '2024-12-31',
            ]);
        }
        
    }
}
