<?php

namespace Database\Factories;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
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
            'cui' => fake()->unique()->numerify('#############'),
            'primer_nombre' => fake()->firstName(),
            'segundo_nombre' => fake()->optional()->firstName(),
            'primer_apellido' => fake()->lastName(),
            'segundo_apellido' => fake()->optional()->lastName(),
            'fecha_nacimiento' => fake()->date('y-m-d'),
            'direccion' => fake()->address(),
            'telefono' => fake()->unique()->phoneNumber(),
            'fecha_contratacion' => fake()->date('y-m-d'),
            'puesto_id' => Puesto::inRandomOrder()->first()->id,
            'sucursal_id' => Sucursal::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
