<?php

namespace Database\Factories;

use App\Models\Vivero;
use App\Models\Finca;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViveroFactory extends Factory
{
    protected $model = Vivero::class;

    public function definition()
    {
        return [
            'codigo' => 'VIV' . $this->faker->unique()->numberBetween(1000, 9999),
            'tipo_cultivo' => $this->faker->randomElement(['Flores', 'Frutas', 'Hortalizas', 'Ornamentales']),
            'finca_id' => Finca::factory(),
        ];
    }
}
