<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $controllers = [
            'articulos',
            'bancos',
            'ciudades',
            'linea-negocios',
            'liquidacion-concepto',
            'liquidacion-multas',
            'liquidacion-operadores',
            'liquidacion-recargos',
            'nota-ingresos',
            'noticias',
            'operadores',
            'operador-documentos',
            'pagos',
            'permissions',
            'provincias',
            'roles',
            'territorios',
            'tipo-documentos',
            'tipo-multas',
            'tipo-pagos',
            'tipo-recargos',
            'tipo-servicios',
            'usuarios',
            'zonas',
        ];

        $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];

        $authPermissions = [
            'auth.me',
            'auth.logout',
        ];

        $permissions = [];
        foreach ($controllers as $controller) {
            foreach ($actions as $action) {
                $permissions[] = "{$controller}.{$action}";
            }
        }

        $permissions = array_merge($permissions, $authPermissions);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }
    }
}
