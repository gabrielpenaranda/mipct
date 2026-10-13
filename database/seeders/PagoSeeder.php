<?php

namespace Database\Seeders;

use App\Models\Banco;
use App\Models\Pago;
use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        $bancos = Banco::all();
        $tiposPago = TipoPago::all();

        if ($bancos->isEmpty() || $tiposPago->isEmpty()) {
            $this->command?->warn('Faltan bancos o tipos de pago; abortando PagoSeeder.');

            return;
        }

        $pagosBase = [
            ['monto' => 750.00, 'recibo' => 'REC-2026-0001'],
            ['monto' => 1200.00, 'recibo' => 'REC-2026-0002'],
            ['monto' => 950.00, 'recibo' => 'REC-2026-0003'],
            ['monto' => 500.00, 'recibo' => 'REC-2026-0004'],
            ['monto' => 1500.00, 'recibo' => 'REC-2026-0005'],
        ];

        foreach ($pagosBase as $index => $pago) {
            $banco = $bancos[$index % $bancos->count()];
            $tipoPago = $tiposPago[$index % $tiposPago->count()];

            Pago::firstOrCreate(
                [
                    'numero_recibo' => $pago['recibo'],
                    'banco_id' => $banco->id,
                ],
                [
                    'fecha' => now()->subMonths(5 - $index)->toDateString(),
                    'monto' => $pago['monto'],
                    'tipo_pago_id' => $tipoPago->id,
                ],
            );
        }
    }
}
