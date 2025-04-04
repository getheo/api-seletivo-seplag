<?php

namespace Database\Seeders;

use App\Models\Lotacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Lotacao::where(['pes_id' => 1, 'unid_id' => 1])->first()) {
            Lotacao::create([                
                'pes_id' => 1,
                'unid_id' => 1,
                'lot_data_lotacao' => '2021-01-01',
                'lot_data_remocao' => NULL,
                'lot_portaria' => 'Portaria 01-2025',
            ]);
        }

        if (!Lotacao::where(['pes_id' => 2, 'unid_id' => 1])->first()) {
            Lotacao::create([                
                'pes_id' => 2,
                'unid_id' => 1,
                'lot_data_lotacao' => '2023-11-21',
                'lot_data_remocao' => NULL,
                'lot_portaria' => 'Portaria 01-2023',
            ]);
        }

        if (!Lotacao::where(['pes_id' => 3, 'unid_id' => 2])->first()) {
            Lotacao::create([                
                'pes_id' => 3,
                'unid_id' => 2,
                'lot_data_lotacao' => '2022-06-01',
                'lot_data_remocao' => NULL,
                'lot_portaria' => 'Portaria 01-2022',
            ]);
        }

        if (!Lotacao::where(['pes_id' => 4, 'unid_id' => 3])->first()) {
            Lotacao::create([                
                'pes_id' => 4,
                'unid_id' => 3,
                'lot_data_lotacao' => '2020-02-26',
                'lot_data_remocao' => NULL,
                'lot_portaria' => 'Portaria 01-2020',
            ]);
        }

        if (!Lotacao::where(['pes_id' => 5, 'unid_id' => 3])->first()) {
            Lotacao::create([                
                'pes_id' => 5,
                'unid_id' => 3,
                'lot_data_lotacao' => '1999-12-12',
                'lot_data_remocao' => NULL,
                'lot_portaria' => 'Portaria 01-1999',
            ]);
        }
    }
}
