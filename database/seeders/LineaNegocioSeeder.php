<?php

namespace Database\Seeders;

use App\Models\LineaNegocio;
use Illuminate\Database\Seeder;

class LineaNegocioSeeder extends Seeder
{
    public function run(): void
    {
        $lineaNegocios = [
            [
                'codigo' => 'LN001',
                'nombre' => 'Hospedaje y alojamiento',
                'descipcion' => 'Hoteles, resorts, hostales y demás establecimientos de hospedaje turístico en Guinea Ecuatorial.',
            ],
            [
                'codigo' => 'LN002',
                'nombre' => 'Restauración',
                'descipcion' => 'Restaurantes, bares y servicios de alimentación para turistas y visitantes.',
            ],
            [
                'codigo' => 'LN003',
                'nombre' => 'Transporte turístico',
                'descipcion' => 'Servicios de transporte terrestre, marítimo y aéreo dedicados al sector turístico.',
            ],
            [
                'codigo' => 'LN004',
                'nombre' => 'Agencias de viajes',
                'descipcion' => 'Agencias que ofrecen paquetes, reservas y organización de viajes dentro y fuera del país.',
            ],
            [
                'codigo' => 'LN005',
                'nombre' => 'Turismo de naturaleza',
                'descipcion' => 'Actividades y servicios enfocados en el ecoturismo, parques naturales y reservas de la biodiversidad.',
            ],
            [
                'codigo' => 'LN006',
                'nombre' => 'Turismo cultural',
                'descipcion' => 'Servicios relacionados con el patrimonio histórico, museos, festivales y expresiones culturales locales.',
            ],
            [
                'codigo' => 'LN007',
                'nombre' => 'Ocio y recreación',
                'descipcion' => 'Actividades recreativas, deportes, playas y entretenimiento para visitantes.',
            ],
            [
                'codigo' => 'LN008',
                'nombre' => 'Comercio turístico',
                'descipcion' => 'Tiendas de artesanías, souvenirs y productos típicos dirigidos al turismo.',
            ],
        ];

        foreach ($lineaNegocios as $item) {
            LineaNegocio::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
