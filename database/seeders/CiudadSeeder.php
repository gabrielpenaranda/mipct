<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ciudades = [
            'Annobón' => [['nombre' => 'San Antonio de Palé', 'codigo' => 'CI001']],
            'Bioko Norte' => [
                ['nombre' => 'Malabo', 'codigo' => 'CI002'],
                ['nombre' => 'Rebola', 'codigo' => 'CI003'],
                ['nombre' => 'Baney', 'codigo' => 'CI004'],
            ],
            'Bioko Sur' => [['nombre' => 'Luba', 'codigo' => 'CI005']],
            'Centro Sur' => [
                ['nombre' => 'Evinayong', 'codigo' => 'CI006'],
                ['nombre' => 'Akurenam', 'codigo' => 'CI007'],
                ['nombre' => 'Niefang', 'codigo' => 'CI008'],
            ],
            'Kie-Ntem' => [
                ['nombre' => 'Ebebiyín', 'codigo' => 'CI009'],
                ['nombre' => 'Micomeseng', 'codigo' => 'CI010'],
            ],
            'Litoral' => [
                ['nombre' => 'Bata', 'codigo' => 'CI011'],
                ['nombre' => 'Río Campo', 'codigo' => 'CI012'],
                ['nombre' => 'Cogo', 'codigo' => 'CI013'],
            ],
            'Wele-Nzas' => [
                ['nombre' => 'Mongomo', 'codigo' => 'CI014'],
                ['nombre' => 'Aconibe', 'codigo' => 'CI015'],
                ['nombre' => 'Nsork', 'codigo' => 'CI016'],
            ],
            'Djibloho' => [
                ['nombre' => 'Djibloho', 'codigo' => 'CI017'],
                ['nombre' => 'Oyala', 'codigo' => 'CI018'],
            ],
        ];

        foreach ($ciudades as $provinciaNombre => $ciudadesProvincia) {
            $provinciaId = Provincia::where('nombre', $provinciaNombre)->value('id');
            foreach ($ciudadesProvincia as $ciudad) {
                Ciudad::firstOrCreate(
                    ['nombre' => $ciudad['nombre']],
                    [
                        'codigo' => $ciudad['codigo'],
                        'provincia_id' => $provinciaId,
                    ]
                );
            }
        }
    }
}
