<?php

namespace Database\Seeders;

use App\Models\Banco;
use App\Models\LiquidacionOperador;
use App\Models\NotaIngreso;
use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class NotaIngresoSeeder extends Seeder
{
    public function run(): void
    {
        $bancos = Banco::all();
        $tiposPago = TipoPago::all();
        $liquidaciones = LiquidacionOperador::all();

        if ($bancos->isEmpty() || $tiposPago->isEmpty() || $liquidaciones->isEmpty()) {
            $this->command?->warn('Faltan bancos, tipos de pago o liquidaciones; abortando NotaIngresoSeeder.');

            return;
        }

        $rangos = [
            ['desde' => now()->subMonths(6)->startOfMonth(), 'hasta' => now()->subMonths(6)->endOfMonth(), 'monto' => 1500.00],
            ['desde' => now()->subMonths(4)->startOfMonth(), 'hasta' => now()->subMonths(4)->endOfMonth(), 'monto' => 2300.00],
            ['desde' => now()->subMonths(2)->startOfMonth(), 'hasta' => now()->subMonths(2)->endOfMonth(), 'monto' => 1850.00],
            ['desde' => now()->subMonth()->startOfMonth(), 'hasta' => now()->subMonth()->endOfMonth(), 'monto' => 2750.00],
        ];

        foreach ($rangos as $index => $rango) {
            $liquidacion = $liquidaciones[$index % $liquidaciones->count()];

            NotaIngreso::firstOrCreate(
                [
                    'fecha_desde' => $rango['desde']->toDateString(),
                    'fecha_hasta' => $rango['hasta']->toDateString(),
                ],
                [
                    'monto' => $rango['monto'],
                    'banco_id' => $bancos[$index % $bancos->count()]->id,
                    'tipo_pago_id' => $tiposPago[$index % $tiposPago->count()]->id,
                    'liquidacion_operador_id' => $liquidacion->id,
                ],
            );
        }
    }
}
