<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        $tiposDocumento = [
            ['codigo' => 'DNI', 'nombre' => 'Documento Nacional de Identidad', 'descripcion' => 'Documento de identidad para personas físicas.'],
            ['codigo' => 'NIE', 'nombre' => 'Número de Identidad de Extranjero', 'descripcion' => 'Documento de identidad para extranjeros residentes.'],
            ['codigo' => 'CIF', 'nombre' => 'Código de Identificación Fiscal', 'descripcion' => 'Identificación fiscal para personas jurídicas.'],
            ['codigo' => 'NIF', 'nombre' => 'Número de Identificación Fiscal', 'descripcion' => 'Número de identificación fiscal.'],
            ['codigo' => 'LC', 'nombre' => 'Licencia Comercial', 'descripcion' => 'Licencia para operar comercialmente.'],
            ['codigo' => 'RM', 'nombre' => 'Registro Mercantil', 'descripcion' => 'Inscripción en el registro mercantil.'],
            ['codigo' => 'PS', 'nombre' => 'Pasaporte', 'descripcion' => 'Documento de viaje internacional.'],
        ];

        foreach ($tiposDocumento as $item) {
            TipoDocumento::firstOrCreate(['codigo' => $item['codigo']], $item);
        }
    }
}
