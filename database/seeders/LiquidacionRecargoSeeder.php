<?php

namespace Database\Seeders;

use App\Models\LiquidacionCategoria;
use App\Models\LiquidacionOperador;
use App\Models\LiquidacionRecargo;
use App\Models\TipoRecargo;
use Illuminate\Database\Seeder;

class LiquidacionRecargoSeeder extends Seeder
{
    public function run(): void
    {
        $liquidaciones = LiquidacionOperador::all();
        $tiposRecargo = TipoRecargo::all();
        $categorias = LiquidacionCategoria::all();

        if ($liquidaciones->isEmpty() || $tiposRecargo->isEmpty() || $categorias->isEmpty()) {
            $this->command?->warn('Faltan liquidaciones, tipos de recargo o categorías; abortando LiquidacionRecargoSeeder.');

            return;
        }

        $motivos = [
            'Recargo por declaración presentada fuera del plazo establecido.',
            'Recargo por servicio prestado en horario nocturno no declarado.',
            'Recargo por exceder la capacidad autorizada en la licencia.',
            'Interés moratorio por saldo pendiente de la liquidación anterior.',
        ];

        $contador = 1;
        foreach ($liquidaciones as $liquidacion) {
            if (fake()->boolean(50)) {
                $tipoRecargo = $tiposRecargo->random();
                $categoria = $categorias->random();
                LiquidacionRecargo::firstOrCreate(
                    [
                        'codigo' => (string) $contador++,
                    ],
                    [
                        'descripcion' => $motivos[($contador - 1) % count($motivos)],
                        'tipo_recargo_id' => $tipoRecargo->id,
                        'liquidacion_categoria_id' => $categoria->id,
                        'liquidacion_operador_id' => $liquidacion->id,
                    ]
                );
            }
        }
    }
}
