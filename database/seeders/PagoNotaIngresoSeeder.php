<?php

namespace Database\Seeders;

use App\Models\NotaIngreso;
use App\Models\Pago;
use Illuminate\Database\Seeder;

class PagoNotaIngresoSeeder extends Seeder
{
    public function run(): void
    {
        $pagos = Pago::orderBy('id')->get();
        $notasIngreso = NotaIngreso::orderBy('id')->get();

        if ($pagos->isEmpty() || $notasIngreso->isEmpty()) {
            $this->command?->warn('Faltan pagos o notas de ingreso; abortando PagablesSeeder.');

            return;
        }

        // Mapeo 1:1 - cada pago se vincula a una nota de ingreso
        $vinculaciones = [
            0 => ['nota' => 0],
            1 => ['nota' => 1],
            2 => ['nota' => 2],
            3 => ['nota' => 3],
            4 => ['nota' => 0],
        ];

        $insertados = 0;
        foreach ($pagos as $pagoIndex => $pago) {
            if (! isset($vinculaciones[$pagoIndex])) {
                continue;
            }

            $notaIndex = $vinculaciones[$pagoIndex]['nota'];

            if (! isset($notasIngreso[$notaIndex])) {
                continue;
            }

            $nota = $notasIngreso[$notaIndex];

            // Verificar si ya tiene pago o si el pago ya tiene nota
            if ($nota->pago || $pago->notaIngreso) {
                continue;
            }

            $pago->nota_ingreso_id = $nota->id;
            $pago->save();
            $insertados++;
        }

        $this->command?->info("PagoNotaIngresoSeeder: {$insertados} vinculaciones 1:1 creadas.");
    }
}
