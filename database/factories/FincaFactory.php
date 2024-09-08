<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finca>
 */
class FincaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_catastro' => $this->faker->unique()->numerify('#########'),
            'municipio' => $this->faker->city,
            'productor_id' => \App\Models\Productor::factory(), // Relacionar con un productor
        ];
    }
}
