<?php

namespace Database\Factories;

use App\Models\Ciudad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'direccion' => fake()->streetAddress(),
            'telefono' => fake()->optional(0.7)->numerify('+34 6## ### ###'),
            'empresa' => fake()->optional(0.6)->company(),
            'numero_documento' => (string) fake()->unique()->numerify('########'),
            'tipo_documento' => fake()->randomElement(['dip', 'nie']),
            'carnet' => fake()->optional(0.3)->bothify('??##??##'),
            'es_activo' => true,
            'es_inspector' => false,
            'tipo' => 'contribuyente',
            'ciudad_id' => Ciudad::factory(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }

    public function withTwoFactor(): static
    {
        return $this->state(fn () => [
            'two_factor_secret' => 'base32secret3232',
            'two_factor_confirmed_at' => now(),
        ]);
    }
}
