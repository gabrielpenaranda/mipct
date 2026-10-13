<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            ['nombre' => 'Annobón', 'codigo' => 'PR01'],
            ['nombre' => 'Bioko Norte', 'codigo' => 'PR02'],
            ['nombre' => 'Bioko Sur', 'codigo' => 'PR03'],
            ['nombre' => 'Centro Sur', 'codigo' => 'PR04'],
            ['nombre' => 'Kie-Ntem', 'codigo' => 'PR05'],
            ['nombre' => 'Litoral', 'codigo' => 'PR06'],
            ['nombre' => 'Wele-Nzas', 'codigo' => 'PR07'],
            ['nombre' => 'Djibloho', 'codigo' => 'PR08'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::firstOrCreate(['nombre' => $provincia['nombre']], $provincia);
        }
    }
}
