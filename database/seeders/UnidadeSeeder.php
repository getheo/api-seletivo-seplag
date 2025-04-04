<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Unidade
        if (!Unidade::where('unid_sigla', 'SEPLAG')->first()) {
            Unidade::create([                
                'unid_nome' => 'Secretaria de Planejamento',
                'unid_sigla' => 'SEPLAG',
            ]);
        }

        if (!Unidade::where('unid_sigla', 'SEMA')->first()) {
            Unidade::create([                
                'unid_nome' => 'Secretaria de Meio Ambiente',
                'unid_sigla' => 'SEMA',
            ]);
        }

        if (!Unidade::where('unid_sigla', 'SINFRA')->first()) {
            Unidade::create([                
                'unid_nome' => 'Secretaria de Infraestrutura',
                'unid_sigla' => 'SINFRA',
            ]);
        }

    }
}
