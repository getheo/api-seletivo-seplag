<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Cidade::where('cid_nome', 'Cuiabá')->first()) {
            Cidade::create([                                
                'cid_nome' => 'Cuiabá',
                'cid_uf' => 'MT',
            ]);
        }

        if (!Cidade::where('cid_nome', 'Várzea Grande')->first()) {
            Cidade::create([                                
                'cid_nome' => 'Várzea Grande',
                'cid_uf' => 'MT',
            ]);
        }        

        if (!Cidade::where('cid_nome', 'Rondonópolis')->first()) {
            Cidade::create([                                
                'cid_nome' => 'Rondonópolis',
                'cid_uf' => 'MT',
            ]);
        }
    }
}
