<?php

namespace Database\Seeders;

use App\Models\LineaNegocio;
use App\Models\LiquidacionCategoria;
use App\Models\LiquidacionConcepto;
use Illuminate\Database\Seeder;

class LiquidacionConceptoSeeder extends Seeder
{
    public function run(): void
    {
        $lineaNegocios = LineaNegocio::pluck('id')->all();
        $categorias = LiquidacionCategoria::pluck('id')->all();

        if (empty($lineaNegocios) || empty($categorias)) {
            $this->command?->warn('Faltan líneas de negocio o categorías; abortando LiquidacionConceptoSeeder.');

            return;
        }

        $conceptos = [
            [
                'nombre' => 'Tasa municipal mensual',
                'descripcion' => 'Tasa municipal fija que abonan los operadores turísticos cada mes.',
                'monto' => 500.00,
                'codigo' => 'LCO01',
                'linea_negocio_id' => $lineaNegocios[0],
                'liquidacion_categoria_id' => $categorias[0],
            ],
            [
                'nombre' => 'Contribución por servicios especiales',
                'descripcion' => 'Aporte por servicios turísticos de carácter extraordinario o temporal.',
                'monto' => 350.00,
                'codigo' => 'LCO02',
                'linea_negocio_id' => $lineaNegocios[1],
                'liquidacion_categoria_id' => $categorias[0],
            ],
            [
                'nombre' => 'Licencia anual de operación',
                'descripcion' => 'Cuota anual correspondiente a la licencia de operación turística.',
                'monto' => 1500.00,
                'codigo' => 'LCO03',
                'linea_negocio_id' => $lineaNegocios[2],
                'liquidacion_categoria_id' => $categorias[1],
            ],
            [
                'nombre' => 'Fondo de promoción turística',
                'descripcion' => 'Aporte destinado al fondo de promoción y publicidad del destino.',
                'monto' => 200.00,
                'codigo' => 'LCO04',
                'linea_negocio_id' => $lineaNegocios[3],
                'liquidacion_categoria_id' => $categorias[1],
            ],
            [
                'nombre' => 'Tasa ambiental',
                'descripcion' => 'Tasa orientada a la conservación del entorno natural y zonas protegidas.',
                'monto' => 120.00,
                'codigo' => 'LCO05',
                'linea_negocio_id' => $lineaNegocios[4],
                'liquidacion_categoria_id' => $categorias[2],
            ],
        ];

        foreach ($conceptos as $item) {
            LiquidacionConcepto::firstOrCreate(['nombre' => $item['nombre']], $item);
        }
    }
}
