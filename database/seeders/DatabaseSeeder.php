<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    
    public function run(): void
    {
        $this->call([            
            CidadeSeeder::class,
            EnderecoSeeder::class,
            PessoaSeeder::class,

            PessoaEnderecoSeeder::class,
            
            ServidorEfetivoSeeder::class,
            ServidorTemporarioSeeder::class,
            ServidorTemporarioSeeder::class,

            UnidadeSeeder::class,
            UnidadeEnderecoSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
