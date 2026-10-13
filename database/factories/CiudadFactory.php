<?php

namespace Database\Factories;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ciudad>
 */
class CiudadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('???'),
            'nombre' => fake()->unique()->city(),
            'provincia_id' => Provincia::factory(),
        ];
    }
}
