<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Producto;
use App\Models\Sucursal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'existencia' => fake()->randomNumber(5, false),
            'existencia_minima' => fake()->randomNumber(5, false),
            'existencia_maxima' => fake()->randomNumber(5, false),
            'producto_id' => Producto::inRandomOrder()->first()->id,
            'sucursal_id' => Sucursal::inRandomOrder()->first()->id,
        ];
    }
}
