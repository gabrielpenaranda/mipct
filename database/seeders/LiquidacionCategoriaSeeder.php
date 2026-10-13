<?php

namespace Database\Seeders;

use App\Models\LiquidacionCategoria;
use Illuminate\Database\Seeder;

class LiquidacionCategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'codigo' => 'LC001',
                'nombre' => 'Mensual',
                'descripcion' => 'Conceptos que se liquidan mensualmente.',
            ],
            [
                'codigo' => 'LC002',
                'nombre' => 'Anual',
                'descripcion' => 'Conceptos que se liquidan anualmente.',
            ],
            [
                'codigo' => 'LC003',
                'nombre' => 'Extraordinario',
                'descripcion' => 'Conceptos de liquidación extraordinaria.',
            ],
        ];

        foreach ($categorias as $item) {
            LiquidacionCategoria::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
