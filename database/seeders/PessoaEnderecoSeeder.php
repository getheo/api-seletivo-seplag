<?php

namespace Database\Seeders;

use App\Models\PessoaEndereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessoaEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        // Pessoa Endereço    
        if (!PessoaEndereco::where(['pes_id' => 1, 'end_id' => 4])->first()) {
            PessoaEndereco::create([
                'pes_id' => 1,
                'end_id' => 4,
            ]);
        }

        if (!PessoaEndereco::where(['pes_id' => 2, 'end_id' => 5])->first()) {
            PessoaEndereco::create([
                'pes_id' => 2,
                'end_id' => 5,
            ]);
        }

        if (!PessoaEndereco::where(['pes_id' => 3, 'end_id' => 6])->first()) {
            PessoaEndereco::create([
                'pes_id' => 3,
                'end_id' => 6,
            ]);
        }

        if (!PessoaEndereco::where(['pes_id' => 4, 'end_id' => 7])->first()) {
            PessoaEndereco::create([
                'pes_id' => 4,
                'end_id' => 7,
            ]);
        }

        if (!PessoaEndereco::where(['pes_id' => 5, 'end_id' => 8])->first()) {
            PessoaEndereco::create([
                'pes_id' => 5,
                'end_id' => 8,
            ]);
        }
    }
}
