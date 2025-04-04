<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Pessoa::where('pes_nome', 'Nome da 1ª pessoa')->first()) {
            Pessoa::create([                
                'pes_nome' => 'Nome da 1ª pessoa',
                'pes_data_nascimento' => '2001-10-10',
                'pes_sexo' => 'M',
                'pes_mae' => 'Nome da Mãe 1 pessoa',
                'pes_pai' => 'Nome do Pai 1 pessoa',
            ]);
        }

        if (!Pessoa::where('pes_nome', 'Nome da 2ª pessoa')->first()) {
            Pessoa::create([                
                'pes_nome' => 'Nome da 2ª pessoa',
                'pes_data_nascimento' => '1994-03-21',
                'pes_sexo' => 'F',
                'pes_mae' => 'Nome da Mãe 2 pessoa',
                'pes_pai' => 'Nome do Pai 2 pessoa',
            ]);
        }

        if (!Pessoa::where('pes_nome', 'Nome da 3ª pessoa')->first()) {
            Pessoa::create([                                
                'pes_nome' => 'Nome da 3ª pessoa',
                'pes_data_nascimento' => '1997-08-07',
                'pes_sexo' => 'M',
                'pes_mae' => 'Nome da Mãe 3 pessoa',
                'pes_pai' => 'Nome do Pai 3 pessoa',
            ]);
        }

        if (!Pessoa::where('pes_nome', 'Nome da 4ª pessoa')->first()) {
            Pessoa::create([                                
                'pes_nome' => 'Nome da 4ª pessoa',
                'pes_data_nascimento' => '2016-10-30',
                'pes_sexo' => 'M',
                'pes_mae' => 'Nome da Mãe 4 pessoa',
                'pes_pai' => 'Nome do Pai 4 pessoa',
            ]);
        }

        if (!Pessoa::where('pes_nome', 'Nome da 5ª pessoa')->first()) {
            Pessoa::create([                                
                'pes_nome' => 'Nome da 5ª pessoa',
                'pes_data_nascimento' => '2015-12-12',
                'pes_sexo' => 'F',
                'pes_mae' => 'Nome da Mãe 5 pessoa',
                'pes_pai' => 'Nome do Pai 5 pessoa',
            ]);
        }
    }
}
