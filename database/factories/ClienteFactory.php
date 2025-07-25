<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nit' => fake()->unique()->numerify('#######-#'),
            'primer_nombre' => fake()->unique()->firstName(),
            'segundo_nombre' => fake()->optional()->firstName(),
            'primer_apellido' => fake()->unique()->lastName(),
            'segundo_apellido' => fake()->optional()->lastName(),
            'direccion' => fake()->address(),
            'telefono' => fake()->unique()->phoneNumber(),
            'user_id' => User::factory()->create(['tipo_usuario_id' => 2])->id,
        ];
    }
}
