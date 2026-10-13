<?php

namespace Database\Seeders;

use App\Models\Zona;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zonas = [
            ['nombre' => 'Zona Continental', 'codigo' => 'ZN001', 'description' => 'Región continental de Guinea Ecuatorial (Río Muni).'],
            ['nombre' => 'Zona Insular', 'codigo' => 'ZN002', 'description' => 'Región insular de Guinea Ecuatorial (Bioko y Annobón).'],
            ['nombre' => 'Zona Urbana Malabo', 'codigo' => 'ZN003', 'description' => 'Zona urbana de la ciudad de Malabo.'],
            ['nombre' => 'Zona Urbana Bata', 'codigo' => 'ZN004', 'description' => 'Zona urbana de la ciudad de Bata.'],
            ['nombre' => 'Zona Rural Centro', 'codigo' => 'ZN005', 'description' => 'Zona rural de la región centro sur.'],
        ];

        foreach ($zonas as $zona) {
            Zona::firstOrCreate(
                ['nombre' => $zona['nombre']],
                ['codigo' => $zona['codigo'], 'description' => $zona['description']]
            );
        }
    }
}
