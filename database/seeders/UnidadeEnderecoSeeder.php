<?php

namespace Database\Seeders;

use App\Models\UnidadeEndereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadeEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Unidades Endereços
        if (!UnidadeEndereco::where(['unid_id' => 1, 'end_id' => 1])->first()) {
            UnidadeEndereco::create([
                'unid_id' => 1,
                'end_id' => 1,
            ]);
        }

        if (!UnidadeEndereco::where(['unid_id' => 2, 'end_id' => 2])->first()) {
            UnidadeEndereco::create([
                'unid_id' => 2,
                'end_id' => 2,
            ]);
        }

        if (!UnidadeEndereco::where(['unid_id' => 3, 'end_id' => 3])->first()) {
            UnidadeEndereco::create([
                'unid_id' => 3,
                'end_id' => 3,
            ]);
        }
    }
}
