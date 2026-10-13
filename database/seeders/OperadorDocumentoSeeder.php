<?php

namespace Database\Seeders;

use App\Models\Operador;
use App\Models\OperadorDocumento;
use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class OperadorDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        $operadores = Operador::pluck('id', 'nombre_juridico')->all();
        $tiposDocumento = TipoDocumento::pluck('id', 'codigo')->all();

        if (empty($operadores) || empty($tiposDocumento)) {
            $this->command?->warn('Faltan operadores o tipos de documento; abortando OperadorDocumentoSeeder.');

            return;
        }

        $documentos = [
            [
                'operador' => 'Hotel Bahía de Guinea S.A.',
                'tipo' => 'LC',
                'nombre' => 'Licencia comercial Hotel Bahía 2026',
            ],
            [
                'operador' => 'Hotel Bahía de Guinea S.A.',
                'tipo' => 'CIF',
                'nombre' => 'CIF Hotel Bahía de Guinea S.A.',
            ],
            [
                'operador' => 'Tours Annobón S.L.',
                'tipo' => 'RM',
                'nombre' => 'Registro mercantil Tours Annobón',
            ],
            [
                'operador' => 'Tours Annobón S.L.',
                'tipo' => 'LC',
                'nombre' => 'Licencia turística Tours Annobón 2026',
            ],
            [
                'operador' => 'Restaurante La Guinea Ecuatorial',
                'tipo' => 'LC',
                'nombre' => 'Licencia sanitaria Restaurante La Guinea',
            ],
            [
                'operador' => 'Ceiba Intercontinental',
                'tipo' => 'RM',
                'nombre' => 'Registro mercantil Ceiba Intercontinental',
            ],
            [
                'operador' => 'Ceiba Intercontinental',
                'tipo' => 'LC',
                'nombre' => 'Licencia de operación aérea Ceiba',
            ],
            [
                'operador' => 'Agencia de Viajes Bioko Tours',
                'tipo' => 'LC',
                'nombre' => 'Licencia agencia de viajes Bioko Tours',
            ],
            [
                'operador' => 'Resort Playa de Bata',
                'tipo' => 'CIF',
                'nombre' => 'CIF Resort Playa de Bata',
            ],
            [
                'operador' => 'Resort Playa de Bata',
                'tipo' => 'LC',
                'nombre' => 'Licencia turística Resort Playa de Bata 2026',
            ],
            [
                'operador' => 'María Nguema Obiang',
                'tipo' => 'DNI',
                'nombre' => 'DNI María Nguema Obiang',
            ],
            [
                'operador' => 'María Nguema Obiang',
                'tipo' => 'LC',
                'nombre' => 'Licencia personal María Nguema',
            ],
            [
                'operador' => 'Pedro Nsue Esono',
                'tipo' => 'DNI',
                'nombre' => 'DNI Pedro Nsue Esono',
            ],
            [
                'operador' => 'Pedro Nsue Esono',
                'tipo' => 'LC',
                'nombre' => 'Licencia personal Pedro Nsue',
            ],
        ];

        foreach ($documentos as $item) {
            if (! isset($operadores[$item['operador']], $tiposDocumento[$item['tipo']])) {
                continue;
            }

            OperadorDocumento::firstOrCreate(
                [
                    'operador_id' => $operadores[$item['operador']],
                    'nombre' => $item['nombre'],
                ],
                [
                    'tipo_documento_id' => $tiposDocumento[$item['tipo']],
                ]
            );
        }
    }
}
