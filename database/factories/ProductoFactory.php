<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Categoria;
use App\Models\UnidadMedida;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->sentence(),
            'descripcion' => fake()->sentence(),
            'codigo_barra' => fake()->ean13(),
            'precio_venta' => fake()->randomFloat(2),
            'precio_costo' => fake()->randomFloat(2),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
            'unidad_medida_id' => UnidadMedida::inRandomOrder()->first()->id,
        ];
    }
}
