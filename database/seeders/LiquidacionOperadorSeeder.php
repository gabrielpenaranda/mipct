<?php

namespace Database\Seeders;

use App\Models\LiquidacionCategoria;
use App\Models\LiquidacionConcepto;
use App\Models\LiquidacionOperador;
use App\Models\Operador;
use App\Models\User;
use Illuminate\Database\Seeder;

class LiquidacionOperadorSeeder extends Seeder
{
    public function run(): void
    {
        $operadores = Operador::all();
        $conceptos = LiquidacionConcepto::all();
        $categorias = LiquidacionCategoria::all();
        $usuarios = User::all();

        if ($operadores->isEmpty() || $conceptos->isEmpty() || $categorias->isEmpty() || $usuarios->isEmpty()) {
            $this->command?->warn('Faltan operadores, conceptos, categorías o usuarios; abortando LiquidacionOperadorSeeder.');

            return;
        }

        $conceptosBase = [
            'Liquidación mensual del periodo',
            'Liquidación extraordinaria por temporada alta',
            'Liquidación complementaria por servicios especiales',
        ];

        foreach ($operadores as $operador) {
            for ($i = 0; $i < 3; $i++) {
                $concepto = $conceptos->random();
                $categoria = $categorias->random();
                $usuario = $usuarios->random();

                $totalRecargo = fake()->randomFloat(2, 0, 250);
                $totalMulta = fake()->randomFloat(2, 0, 400);
                $totalLiquidacion = round((float) $concepto->monto + $totalRecargo + $totalMulta, 2);

                $fechaEmision = now()->subMonths($i)->startOfMonth();
                $fechaVencimiento = now()->subMonths($i)->endOfMonth();

                LiquidacionOperador::firstOrCreate(
                    [
                        'numero_liquidacion' => 'LIQ-'.$operador->id.'-'.$fechaEmision->format('Ym').'-'.($i + 1),
                    ],
                    [
                        'operador_id' => $operador->id,
                        'user_id' => $usuario->id,
                        'liquidacion_categoria_id' => $categoria->id,
                        'liquidacion_concepto_id' => $concepto->id,
                        'descripcion_concepto' => $conceptosBase[$i].' - '.$operador->nombre_juridico,
                        'descripcion_recargo' => $totalRecargo > 0 ? 'Recargo aplicado: '.$totalRecargo : null,
                        'descripcion_multa' => $totalMulta > 0 ? 'Multa aplicada: '.$totalMulta : null,
                        'codigo_concepto' => (string) $concepto->codigo,
                        'codigo_recargo' => $totalRecargo > 0 ? 'REC-'.$concepto->codigo : null,
                        'codigo_multa' => $totalMulta > 0 ? 'MUL-'.$concepto->codigo : null,
                        'total_concepto' => $concepto->monto,
                        'total_recargo' => $totalRecargo,
                        'total_multa' => $totalMulta,
                        'fecha_emision' => $fechaEmision->toDateString(),
                        'fecha_vencimiento' => $fechaVencimiento->toDateString(),
                        'total_liquidacion' => $totalLiquidacion,
                        'es_pagado' => $i === 0 ? false : fake()->boolean(70),
                    ],
                );
            }
        }
    }
}
