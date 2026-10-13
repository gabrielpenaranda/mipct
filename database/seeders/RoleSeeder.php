<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $administrador = Role::firstOrCreate(
            ['name' => 'administrador', 'guard_name' => 'web'],
            ['name' => 'administrador', 'guard_name' => 'web']
        );

        $contribuyente = Role::firstOrCreate(
            ['name' => 'contribuyente', 'guard_name' => 'web'],
            ['name' => 'contribuyente', 'guard_name' => 'web']
        );

        $funcionario = Role::firstOrCreate(
            ['name' => 'funcionario', 'guard_name' => 'web'],
            ['name' => 'funcionario', 'guard_name' => 'web']
        );

        $inspector = Role::firstOrCreate(
            ['name' => 'inspector', 'guard_name' => 'web'],
            ['name' => 'inspector', 'guard_name' => 'web']
        );

        $administrador->syncPermissions(Permission::pluck('name')->all());

        $funcionarioPermissions = [
            'auth.logout',
            'auth.me',
            'ciudades.index',
            'ciudades.show',
            'provincias.index',
            'provincias.show',
            'zonas.index',
            'zonas.show',
            'territorios.index',
            'territorios.show',
        ];

        $inspectorPermissions = [
            'auth.logout',
            'auth.me',
            'ciudades.index',
            'ciudades.show',
            'provincias.index',
            'provincias.show',
            'zonas.index',
            'zonas.show',
            'territorios.index',
            'territorios.show',
        ];

        $contribuyentePermissions = [
            'auth.logout',
            'ciudades.index',
            'ciudades.show',
        ];

        sort($funcionarioPermissions);
        sort($inspectorPermissions);
        sort($contribuyentePermissions);

        $funcionario->syncPermissions($funcionarioPermissions);
        $inspector->syncPermissions($inspectorPermissions);
        $contribuyente->syncPermissions($contribuyentePermissions);
    }
}
