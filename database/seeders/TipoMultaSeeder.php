<?php

namespace Database\Seeders;

use App\Models\TipoMulta;
use Illuminate\Database\Seeder;

class TipoMultaSeeder extends Seeder
{
    public function run(): void
    {
        $tiposMulta = [
            [
                'codigo' => 'TM001',
                'nombre' => 'Mora por pago fuera de plazo',
                'descripcion' => 'Sanción por incumplimiento de la fecha límite de pago de la liquidación.',
                'concepto' => 'Aplica un recargo porcentual sobre el total adeudado por cada periodo vencido.',
                'monto' => 50.00,
            ],
            [
                'codigo' => 'TM002',
                'nombre' => 'Incumplimiento de servicio',
                'descripcion' => 'Multa por no prestar el servicio turístico declarado en la licencia.',
                'concepto' => 'Sanción fija por cada denuncia verificada de servicio no prestado.',
                'monto' => 200.00,
            ],
            [
                'codigo' => 'TM003',
                'nombre' => 'Documentación vencida',
                'descripcion' => 'Sanción por operar con permisos, licencias o documentos caducados.',
                'concepto' => 'Multa fija hasta regularizar la documentación ante la autoridad competente.',
                'monto' => 150.00,
            ],
            [
                'codigo' => 'TM004',
                'nombre' => 'Falta de declaración',
                'descripcion' => 'Multa por no presentar las declaraciones mensuales requeridas.',
                'concepto' => 'Aplica por cada periodo mensual no declarado dentro del plazo establecido.',
                'monto' => 100.00,
            ],
            [
                'codigo' => 'TM005',
                'nombre' => 'Infracción sanitaria',
                'descripcion' => 'Sanción por incumplimiento de las normas higiénico-sanitarias vigentes.',
                'concepto' => 'Multa variable según la gravedad de la infracción comprobada.',
                'monto' => 300.00,
            ],
            [
                'codigo' => 'TM006',
                'nombre' => 'Sobreprecio no autorizado',
                'descripcion' => 'Multa por cobrar tarifas superiores a las autorizadas oficialmente.',
                'concepto' => 'Sanción calculada sobre el exceso cobrado al usuario final.',
                'monto' => 250.00,
            ],
        ];

        foreach ($tiposMulta as $item) {
            TipoMulta::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
