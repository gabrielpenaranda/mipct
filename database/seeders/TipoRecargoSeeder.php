<?php

namespace Database\Seeders;

use App\Models\TipoRecargo;
use Illuminate\Database\Seeder;

class TipoRecargoSeeder extends Seeder
{
    public function run(): void
    {
        $tiposRecargo = [
            [
                'codigo' => 'TR001',
                'nombre' => 'Recargo por declaración tardía',
                'descripcion' => 'Recargo aplicable cuando la liquidación se presenta fuera del plazo establecido.',
                'concepto' => 'Porcentaje adicional sobre el total de la liquidación según dias de retraso.',
                'monto' => 25.00,
            ],
            [
                'codigo' => 'TR002',
                'nombre' => 'Recargo por horario nocturno',
                'descripcion' => 'Recargo por servicios turísticos prestados en horario nocturno no declarado.',
                'concepto' => 'Tarifa fija por cada jornada nocturna no declarada previamente.',
                'monto' => 75.00,
            ],
            [
                'codigo' => 'TR003',
                'nombre' => 'Recargo por capacidad excedida',
                'descripcion' => 'Recargo por operar por encima de la capacidad autorizada en la licencia.',
                'concepto' => 'Monto fijo por cada excedente sobre la capacidad registrada.',
                'monto' => 180.00,
            ],
            [
                'codigo' => 'TR004',
                'nombre' => 'Recargo por zona restringida',
                'descripcion' => 'Recargo por ofrecer servicios en zonas geográficas no autorizadas.',
                'concepto' => 'Tarifa fija por jornada en zonas no habilitadas para el servicio.',
                'monto' => 220.00,
            ],
            [
                'codigo' => 'TR005',
                'nombre' => 'Interés por mora',
                'descripcion' => 'Interés moratorio por deudas liquidadas y no pagadas dentro del plazo.',
                'concepto' => 'Porcentaje diario aplicable sobre el saldo pendiente de pago.',
                'monto' => 15.00,
            ],
        ];

        foreach ($tiposRecargo as $item) {
            TipoRecargo::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
