<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\LineaNegocio;
use App\Models\Operador;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Database\Seeder;

class OperadorSeeder extends Seeder
{
    public function run(): void
    {
        $ciudades = Ciudad::pluck('id')->all();
        $tiposServicio = TipoServicio::pluck('id')->all();
        $lineasNegocio = LineaNegocio::pluck('id')->all();
        $usuarios = User::pluck('id')->all();

        if (empty($ciudades) || empty($tiposServicio) || empty($lineasNegocio) || empty($usuarios)) {
            $this->command?->warn('Faltan datos base (ciudades, tipos, líneas o usuarios); abortando OperadorSeeder.');

            return;
        }

        $operadores = [
            [
                'nombre_juridico' => 'Hotel Bahía de Guinea S.A.',
                'correo_empresa' => 'reservas@hotelbahiaguinea.com',
                'nif' => 'GE001234567',
                'direccion' => 'Av. de la Independencia 25, Malabo',
                'telefono' => '+240 333 090001',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Tours Annobón S.L.',
                'correo_empresa' => 'info@toursannobon.com',
                'nif' => 'GE002345678',
                'direccion' => 'Calle del Mar 8, Malabo',
                'telefono' => '+240 333 090002',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Restaurante La Guinea Ecuatorial',
                'correo_empresa' => 'contacto@laguinea.com',
                'nif' => 'GE003456789',
                'direccion' => 'Av. Hassan II 14, Bata',
                'telefono' => '+240 333 090003',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Ceiba Intercontinental',
                'correo_empresa' => 'contacto@ceibaintercontinental.com',
                'nif' => 'GE004567890',
                'direccion' => 'Aeropuerto de Malabo, Malabo',
                'telefono' => '+240 333 090004',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Agencia de Viajes Bioko Tours',
                'correo_empresa' => 'hola@biokotours.com',
                'nif' => 'GE005678901',
                'direccion' => 'Calle del Rey Boncoro 5, Malabo',
                'telefono' => '+240 333 090005',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Resort Playa de Bata',
                'correo_empresa' => 'reservas@resortplayabata.com',
                'nif' => 'GE006789012',
                'direccion' => 'Paseo Marítimo s/n, Bata',
                'telefono' => '+240 333 090006',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'María Nguema Obiang',
                'correo_empresa' => 'maria.nguema.operador@mail.com',
                'nif' => 'GE007890123',
                'direccion' => 'Barrio Mondoasi, Malabo',
                'telefono' => '+240 222 090007',
                'imagen_nif' => null,
            ],
            [
                'nombre_juridico' => 'Pedro Nsue Esono',
                'correo_empresa' => 'pedro.nsue.operador@mail.com',
                'nif' => 'GE008901234',
                'direccion' => 'Av. de las Naciones Unidas 12, Bata',
                'telefono' => '+240 222 090008',
                'imagen_nif' => null,
            ],
        ];

        foreach ($operadores as $index => $item) {
            Operador::firstOrCreate(
                ['nombre_juridico' => $item['nombre_juridico']],
                [
                    'codigo' => str_pad((string) ($index + 1), 5, '0', STR_PAD_LEFT),
                    'correo_empresa' => $item['correo_empresa'],
                    'nif' => $item['nif'],
                    'direccion' => $item['direccion'],
                    'telefono' => $item['telefono'],
                    'imagen_nif' => $item['imagen_nif'],
                    'ciudad_id' => $ciudades[$index % count($ciudades)],
                    'user_id' => $usuarios[$index % count($usuarios)],
                    'tipo_servicio_id' => $tiposServicio[$index % count($tiposServicio)],
                    'linea_negocio_id' => $lineasNegocio[$index % count($lineasNegocio)],
                ]
            );
        }
    }
}
