<?php

namespace Database\Factories;

use App\Models\ProductoControl;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductoControl>
 */
class ProductoControlFactory extends Factory
{
    protected $model = ProductoControl::class;

    public function definition()
    {
        return [
            'registro_ica' => strtoupper($this->faker->bothify('???###')), // 3-10 caracteres alfanuméricos en mayúscula
            'nombre_producto' => $this->faker->words(3, true),
            'frecuencia_aplicacion' => $this->faker->numberBetween(1, 30),
            'valor' => $this->faker->randomFloat(2, 0, 1000), // Valor positivo
            'tipo_control' => $this->faker->randomElement(['hongo', 'plaga', 'fertilizante']),
            'nombre_hongo' => null, // Inicialmente null
            'periodo_carencia' => null, // Inicialmente null
            'fecha_ultima_aplicacion' => null, // Inicialmente null
        ];
    }

    public function tipoHongo()
    {
        return $this->state(function () {
            return [
                'tipo_control' => 'hongo',
                'nombre_hongo' => $this->faker->word,
            ];
        });
    }

    public function tipoPlaga()
    {
        return $this->state(function () {
            return [
                'tipo_control' => 'plaga',
                'periodo_carencia' => $this->faker->numberBetween(0, 100),
            ];
        });
    }

    public function tipoFertilizante()
    {
        return $this->state(function () {
            return [
                'tipo_control' => 'fertilizante',
                'fecha_ultima_aplicacion' => $this->faker->date(),
            ];
        });
    }
}
