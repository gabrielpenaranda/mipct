<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    public function run(): void
    {
        $bancos = [
            ['nombre' => 'BANGE - Banco Nacional de Guinea Ecuatorial', 'codigo' => 'BA001'],
            ['nombre' => 'CCEI Bank - Caja Comunitaria de África Central', 'codigo' => 'BA002'],
            ['nombre' => 'BGFI Bank - Banco de Financiamiento e Inversión', 'codigo' => 'BA003'],
            ['nombre' => 'Afriland First Bank', 'codigo' => 'BA004'],
            ['nombre' => 'Société Générale de Banques en Guinée Equatoriale', 'codigo' => 'BA005'],
            ['nombre' => 'Banco Santander Guinea Ecuatorial', 'codigo' => 'BA006'],
            ['nombre' => 'Ecobank Guinea Ecuatorial', 'codigo' => 'BA007'],
        ];

        foreach ($bancos as $item) {
            Banco::firstOrCreate(
                ['nombre' => $item['nombre']],
                ['codigo' => $item['codigo']],
            );
        }
    }
}
