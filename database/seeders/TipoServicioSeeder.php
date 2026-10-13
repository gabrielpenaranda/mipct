<?php

namespace Database\Seeders;

use App\Models\TipoServicio;
use Illuminate\Database\Seeder;

class TipoServicioSeeder extends Seeder
{
    public function run(): void
    {
        $tipoServicios = [
            [
                'codigo' => 'TS001',
                'nombre' => 'Transporte terrestre',
                'descripcion' => 'Servicios de transporte de pasajeros y carga por carretera dentro del territorio nacional.',
            ],
            [
                'codigo' => 'TS002',
                'nombre' => 'Transporte marítimo',
                'descripcion' => 'Servicios de transporte por mar entre los puertos de Guinea Ecuatorial y destinos internacionales.',
            ],
            [
                'codigo' => 'TS003',
                'nombre' => 'Transporte aéreo',
                'descripcion' => 'Servicios de transporte aéreo de pasajeros y carga desde los aeropuertos de Malabo y Bata.',
            ],
            [
                'codigo' => 'TS004',
                'nombre' => 'Hospedaje y alojamiento',
                'descripcion' => 'Servicios de hospedaje en hoteles, resorts y establecimientos turísticos del país.',
            ],
            [
                'codigo' => 'TS005',
                'nombre' => 'Restauración y gastronomía',
                'descripcion' => 'Servicios de alimentación, restaurantes y oferta culinaria dirigida a turistas y visitantes.',
            ],
            [
                'codigo' => 'TS006',
                'nombre' => 'Turismo y excursiones',
                'descripcion' => 'Servicios de guías turísticos, excursiones organizadas y actividades recreativas.',
            ],
            [
                'codigo' => 'TS007',
                'nombre' => 'Alquiler de vehículos',
                'descripcion' => 'Servicios de arrendamiento de automóviles y vehículos motorizados para turistas y empresas.',
            ],
            [
                'codigo' => 'TS008',
                'nombre' => 'Servicios financieros',
                'descripcion' => 'Servicios de cambio de divisas, banca y pagos electrónicos para el sector turístico.',
            ],
        ];

        foreach ($tipoServicios as $item) {
            TipoServicio::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
