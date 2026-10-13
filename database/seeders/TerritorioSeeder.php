<?php

namespace Database\Seeders;

use App\Models\Territorio;
use App\Models\Zona;
use Illuminate\Database\Seeder;

class TerritorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $territorios = [
            'Zona Continental' => [
                ['nombre' => 'Río Muni Norte', 'codigo' => 'TE001', 'description' => 'Territorio norte de la región continental.', 'es_asignado' => false],
                ['nombre' => 'Río Muni Sur', 'codigo' => 'TE002', 'description' => 'Territorio sur de la región continental.', 'es_asignado' => true],
                ['nombre' => 'Niefang', 'codigo' => 'TE003', 'description' => 'Territorio del distrito de Niefang.', 'es_asignado' => false],
            ],
            'Zona Insular' => [
                ['nombre' => 'Bioko Norte', 'codigo' => 'TE004', 'description' => 'Territorio insular de Bioko Norte.', 'es_asignado' => true],
                ['nombre' => 'Bioko Sur', 'codigo' => 'TE005', 'description' => 'Territorio insular de Bioko Sur.', 'es_asignado' => false],
                ['nombre' => 'Annobón', 'codigo' => 'TE006', 'description' => 'Isla de Annobón.', 'es_asignado' => false],
            ],
            'Zona Urbana Malabo' => [
                ['nombre' => 'Malabo Centro', 'codigo' => 'TE007', 'description' => 'Casco urbano de Malabo.', 'es_asignado' => true],
                ['nombre' => 'Malabo Periferia', 'codigo' => 'TE008', 'description' => 'Zonas periféricas de Malabo.', 'es_asignado' => false],
            ],
            'Zona Urbana Bata' => [
                ['nombre' => 'Bata Centro', 'codigo' => 'TE009', 'description' => 'Casco urbano de Bata.', 'es_asignado' => true],
                ['nombre' => 'Bata Periferia', 'codigo' => 'TE010', 'description' => 'Zonas periféricas de Bata.', 'es_asignado' => false],
            ],
            'Zona Rural Centro' => [
                ['nombre' => 'Evinayong', 'codigo' => 'TE011', 'description' => 'Territorio rural de Evinayong.', 'es_asignado' => false],
                ['nombre' => 'Akurenam', 'codigo' => 'TE012', 'description' => 'Territorio rural de Akurenam.', 'es_asignado' => false],
            ],
        ];

        foreach ($territorios as $zonaNombre => $items) {
            $zona = Zona::where('nombre', $zonaNombre)->first();

            if (! $zona) {
                continue;
            }

            foreach ($items as $territorio) {
                Territorio::firstOrCreate(
                    ['nombre' => $territorio['nombre']],
                    [
                        'codigo' => $territorio['codigo'],
                        'description' => $territorio['description'],
                        'es_asignado' => $territorio['es_asignado'],
                        'zona_id' => $zona->id,
                    ]
                );
            }
        }
    }
}
