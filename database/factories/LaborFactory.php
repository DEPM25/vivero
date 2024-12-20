<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Labor>
 */
class LaborFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Labor::class;
    public function definition(): array
    {
            return [
                'vivero_id' => \App\Models\Vivero::factory(),
                'fecha_realizacion' => $this->faker->date(),
                'descripcion' => $this->faker->sentence(),
            ];       
    
    }
}
