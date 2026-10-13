<?php

namespace Database\Factories;

use App\Models\LiquidacionCategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LiquidacionCategoria>
 */
class LiquidacionCategoriaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('??'),
            'nombre' => fake()->unique()->word(),
            'descripcion' => fake()->sentence(),
        ];
    }
}
