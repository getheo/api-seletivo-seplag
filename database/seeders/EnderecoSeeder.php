<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Endereço para as Unidades
        if (!Endereco::where('end_logradouro', 'Rua C - Complexo Paiaguás')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Bloco III',
                'end_logradouro' => 'Rua C - Complexo Paiaguás',
                'end_numero' => 34,
                'end_bairro' => 'Centro Político Administrativo',
                'cid_id' => 1,
            ]);
        }

        if (!Endereco::where('end_logradouro', 'Rua C')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Complexo Paiaguás',
                'end_logradouro' => 'Rua C',
                'end_numero' => 15,
                'end_bairro' => 'Centro Político Administrativo',
                'cid_id' => 1,
            ]);
        }

        if (!Endereco::where('end_logradouro', 'R. Eng. Edgar Prado Arze')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Complexo Paiaguás',
                'end_logradouro' => 'R. Eng. Edgar Prado Arze',
                'end_numero' => 75,
                'end_bairro' => 'Centro Político Administrativo',
                'cid_id' => 1,
            ]);
        }

        // Endereco para as Pessoas
        if (!Endereco::where('end_logradouro', 'Rua do endereço da 1 Pessoa')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Tipo de logradouro da 1 pessoa',
                'end_logradouro' => 'Rua do endereço da 1 Pessoa',
                'end_numero' => 45,
                'end_bairro' => 'Bairro da primeira pessoa',
                'cid_id' => 1,
            ]);
        }

        // Endereco para as Pessoas
        if (!Endereco::where('end_logradouro', 'Rua do endereço da 2 Pessoa em VG')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Tipo de logradouro da 2 pessoa',
                'end_logradouro' => 'Rua do endereço da 2 Pessoa em VG',
                'end_numero' => 0,
                'end_bairro' => 'Bairro da segunda pessoa',
                'cid_id' => 2,
            ]);
        }

        // Endereco para as Pessoas
        if (!Endereco::where('end_logradouro', 'Rua do endereço da 3 Pessoa em ROO')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Tipo de logradouro da 3 pessoa',
                'end_logradouro' => 'Rua do endereço da 3 Pessoa em ROO',
                'end_numero' => 18,
                'end_bairro' => 'Bairro da terceira pessoa',
                'cid_id' => 3,
            ]);
        }

        // Endereco para as Pessoas
        if (!Endereco::where('end_logradouro', 'Rua do endereço da 4 Pessoa Cba')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Tipo de logradouro da 4 pessoa',
                'end_logradouro' => 'Rua do endereço da 4 Pessoa Cba',
                'end_numero' => 02,
                'end_bairro' => 'Bairro da quarta pessoa',
                'cid_id' => 1,
            ]);
        }

        // Endereco para as Pessoas
        if (!Endereco::where('end_logradouro', 'Rua do endereço da 5 Pessoa VG')->first()) {
            Endereco::create([                
                'end_tipo_logradouro' => 'Tipo de logradouro da 5 pessoa',
                'end_logradouro' => 'Rua do endereço da 5 Pessoa VG',
                'end_numero' => 10,
                'end_bairro' => 'Bairro da quinta pessoa',
                'cid_id' => 2,
            ]);
        }
    }
}
