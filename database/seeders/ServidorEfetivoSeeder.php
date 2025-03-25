<?php

namespace Database\Seeders;

use App\Models\ServidorEfetivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServidorEfetivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!ServidorEfetivo::where('pes_id', 1)->first()) {
            ServidorEfetivo::create([
                'pes_id' => 1,
                'se_matricula' => '000001-A',
            ]);
        }

        if (!ServidorEfetivo::where('pes_id', 2)->first()) {
            ServidorEfetivo::create([
                'pes_id' => 2,
                'se_matricula' => '000002-B',
            ]);
        }

        if (!ServidorEfetivo::where('pes_id', 3)->first()) {
            ServidorEfetivo::create([
                'pes_id' => 3,
                'se_matricula' => '000003-C',
            ]);
        }
        
    }
}
