<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Provider\FakeCar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoTransmision>
 */
class TipoTransmisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakeCar($this->faker));
        
        return [
            //'nombre' => fake()->randomElement(['Manual', 'Automático', 'CVT', 'Semi-Automático'])
            'nombre' => $this->faker->unique()->vehicleGearBoxType()
        ];
    }
}
