<?php

namespace Database\Seeders;

use App\Models\LiquidacionCategoria;
use App\Models\LiquidacionMulta;
use App\Models\LiquidacionOperador;
use App\Models\TipoMulta;
use Illuminate\Database\Seeder;

class LiquidacionMultaSeeder extends Seeder
{
    public function run(): void
    {
        $liquidaciones = LiquidacionOperador::all();
        $tiposMulta = TipoMulta::all();
        $categorias = LiquidacionCategoria::all();

        if ($liquidaciones->isEmpty() || $tiposMulta->isEmpty() || $categorias->isEmpty()) {
            $this->command?->warn('Faltan liquidaciones, tipos de multa o categorías; abortando LiquidacionMultaSeeder.');

            return;
        }

        $motivos = [
            'Mora por pago fuera de plazo correspondiente al periodo.',
            'Sanción aplicada tras inspección por incumplimiento del servicio declarado.',
            'Multa generada por presentar documentación vencida al momento del control.',
            'Sanción por no presentar la declaración mensual en el plazo reglamentario.',
        ];

        $contador = 1;
        foreach ($liquidaciones as $liquidacion) {
            if (fake()->boolean(60)) {
                $tipoMulta = $tiposMulta->random();
                $categoria = $categorias->random();
                LiquidacionMulta::firstOrCreate(
                    [
                        'codigo' => (string) $contador++,
                    ],
                    [
                        'descripcion' => $motivos[($contador - 1) % count($motivos)],
                        'tipo_multa_id' => $tipoMulta->id,
                        'liquidacion_categoria_id' => $categoria->id,
                        'liquidacion_operador_id' => $liquidacion->id,
                    ]
                );
            }
        }
    }
}
