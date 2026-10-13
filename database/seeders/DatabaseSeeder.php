<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call([
            ProvinciaSeeder::class,
            CiudadSeeder::class,
            UserSeeder::class,
            ZonaSeeder::class,
            TerritorioSeeder::class,
            TipoServicioSeeder::class,
            LineaNegocioSeeder::class,
            OperadorSeeder::class,
            TipoDocumentoSeeder::class,
            OperadorDocumentoSeeder::class,
            BancoSeeder::class,
            TipoPagoSeeder::class,
            TipoMultaSeeder::class,
            TipoRecargoSeeder::class,
            LiquidacionCategoriaSeeder::class,
            LiquidacionConceptoSeeder::class,
            LiquidacionOperadorSeeder::class,
            LiquidacionMultaSeeder::class,
            LiquidacionRecargoSeeder::class,
            NotaIngresoSeeder::class,
            PagoSeeder::class,
            PagoNotaIngresoSeeder::class,
        ]);
    }
}
