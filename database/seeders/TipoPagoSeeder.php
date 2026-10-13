<?php

namespace Database\Seeders;

use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    public function run(): void
    {
        $tiposPago = [
            ['nombre' => 'Efectivo', 'codigo' => 'TP001'],
            ['nombre' => 'Transferencia bancaria', 'codigo' => 'TP002'],
            ['nombre' => 'Cheque', 'codigo' => 'TP003'],
            ['nombre' => 'Tarjeta de débito', 'codigo' => 'TP004'],
            ['nombre' => 'Tarjeta de crédito', 'codigo' => 'TP005'],
            ['nombre' => 'Pago móvil', 'codigo' => 'TP006'],
            ['nombre' => 'Depósito en cuenta', 'codigo' => 'TP007'],
        ];

        foreach ($tiposPago as $item) {
            TipoPago::firstOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
