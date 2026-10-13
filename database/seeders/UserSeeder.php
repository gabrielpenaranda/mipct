<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Gabriel Peñaranda', 'email' => 'gabrielpg77@gmail.com', 'type' => 'administrador'],
            ['name' => 'Carlos Martínez', 'email' => 'andrewsogemer@mail.com', 'type' => 'administrador'],
            ['name' => 'Manuel Nguema', 'email' => 'manueln.guema@mail.com', 'type' => 'funcionario'],
            ['name' => 'Juan Ndong', 'email' => 'juan.ndong@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Antonio Mba', 'email' => 'antonio.mba@mail.com', 'type' => 'contribuyente'],
            ['name' => 'José Ondo', 'email' => 'jose.ondo@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Francisco Esono', 'email' => 'francisco.esono@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Pedro Nsue', 'email' => 'pedro.nsue@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Baltasar Mangue', 'email' => 'baltasar.mangue@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Ambrosio Nchama', 'email' => 'ambrosio.nchama@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Eleuterio Obiang', 'email' => 'eleuterio.obiang@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Beltrán Obama', 'email' => 'beltran.obama@mail.com', 'type' => 'contribuyente'],
            ['name' => 'María Nguema', 'email' => 'maria.nguema@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Isabel Ndong', 'email' => 'isabel.ndong@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Teresa Mba', 'email' => 'teresa.mba@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Esperanza Ondo', 'email' => 'esperanza.ondo@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Milagrosa Esono', 'email' => 'milagrosa.esono@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Ana Nsue', 'email' => 'ana.nsue@mail.com', 'type' => 'funcionario'],
            ['name' => 'Beatriz Mangue', 'email' => 'beatriz.mangue@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Carmen Nchama', 'email' => 'carmen.nchama@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Gloria Obiang', 'email' => 'gloria.obiang@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Rosa Obama', 'email' => 'rosa.obama@mail.com', 'type' => 'contribuyente'],
            ['name' => 'Ladislao Mba Obama', 'email' => 'ladislao.mba@mail.com', 'type' => 'funcionario', 'es_inspector' => true],
            ['name' => 'Generosa Ndong Asumu', 'email' => 'generosa.ndong@mail.com', 'type' => 'funcionario', 'es_inspector' => true],
        ];

        $ciudades = Ciudad::pluck('id')->all();

        if (empty($ciudades)) {
            $this->command?->warn('No hay ciudades sembradas; abortando UserSeeder.');

            return;
        }

        foreach ($users as $index => $data) {
            $partes = explode(' ', trim($data['name']), 2);
            $nombre = $partes[0];
            $apellido = $partes[1] ?? 'Apellido';

            $esInspector = (bool) ($data['es_inspector'] ?? false);
            $tipo = $data['type'];

            $rolNombre = match (true) {
                $tipo === 'funcionario' && $esInspector => 'inspector',
                $tipo === 'funcionario' => 'funcionario',
                $tipo === 'administrador' => 'administrador',
                default => 'contribuyente',
            };
            $tipoEnum = in_array($tipo, ['funcionario', 'contribuyente'], true) ? $tipo : 'funcionario';
            $esFuncionario = $tipoEnum === 'funcionario';

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'direccion' => 'Calle Principal #'.($index + 1).', Guinea Ecuatorial',
                    'telefono' => '+240 555 '.str_pad((string) $index, 4, '0', STR_PAD_LEFT),
                    'empresa' => $esFuncionario ? null : 'Empresa '.$nombre,
                    'numero_documento' => str_pad((string) (1000000 + $index), 7, '0', STR_PAD_LEFT),
                    'tipo_documento' => 'dip',
                    'carnet' => $esFuncionario ? str_pad((string) (2000000 + $index), 7, '0', STR_PAD_LEFT) : null,
                    'es_activo' => true,
                    'es_inspector' => $esInspector,
                    'tipo' => $tipoEnum,
                    'password' => 'password',
                    'ciudad_id' => $ciudades[$index % count($ciudades)],
                ]
            );

            $rol = Role::findByName($rolNombre, 'web');
            if ($rol) {
                $user->assignRole($rol);
            }
        }
    }
}
