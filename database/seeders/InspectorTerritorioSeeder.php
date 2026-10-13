<?php

namespace Database\Seeders;

use App\Models\Territorio;
use App\Models\User;
use Illuminate\Database\Seeder;

class InspectorTerritorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inspectores = User::where('es_inspector', true)->get();

        if ($inspectores->isEmpty()) {
            $this->command?->warn('No hay usuarios con es_inspector=true; abortando InspectorTerritorioSeeder.');

            return;
        }

        $territorios = Territorio::all();

        if ($territorios->isEmpty()) {
            $this->command?->warn('No hay territorios sembrados; abortando InspectorTerritorioSeeder.');

            return;
        }

        foreach ($inspectores as $inspector) {
            $cantidad = 2;
            $asignados = $territorios->random(min($cantidad, $territorios->count()));

            $inspector->territorios()->syncWithoutDetaching($asignados->pluck('id')->all());
        }
    }
}
