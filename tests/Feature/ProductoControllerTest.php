<?php

namespace Tests\Feature;

use App\Models\ProductoControl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{
private function validate(array $data)
    {
        return Validator::make($data, ProductoControl::rules());
    }


    /** @test */
    public function valida_datos_para_tipo_control_hongo()
    {
        $producto = ProductoControl::factory()->tipoHongo()->make()->toArray();
        $validator = $this->validate($producto);

        $this->assertFalse($validator->fails(), 'El estado tipoHongo generó datos inválidos');
    }

    /** @test */
    public function valida_datos_para_tipo_control_plaga()
    {
        $producto = ProductoControl::factory()->tipoPlaga()->make()->toArray();
        $validator = $this->validate($producto);

        $this->assertFalse($validator->fails(), 'El estado tipoPlaga generó datos inválidos');
    }

    /** @test */
    public function valida_datos_para_tipo_control_fertilizante()
    {
        $producto = ProductoControl::factory()->tipoFertilizante()->make()->toArray();
        $validator = $this->validate($producto);

        $this->assertFalse($validator->fails(), 'El estado tipoFertilizante generó datos inválidos');
    }

    /** @test */
    public function nombre_hongo_es_requerido_cuando_tipo_control_es_hongo()
    {
        $data = ProductoControl::factory()->make([
            'tipo_control' => 'hongo',
            'nombre_hongo' => null, // Simula datos inválidos
        ])->toArray();

        $validator = $this->validate($data);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nombre_hongo', $validator->errors()->toArray());
    }

    /** @test */
    public function periodo_carencia_es_requerido_cuando_tipo_control_es_plaga()
    {
        $data = ProductoControl::factory()->make([
            'tipo_control' => 'plaga',
            'periodo_carencia' => null, // Simula datos inválidos
        ])->toArray();

        $validator = $this->validate($data);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('periodo_carencia', $validator->errors()->toArray());
    }

    /** @test */
    public function fecha_ultima_aplicacion_es_requerida_cuando_tipo_control_es_fertilizante()
    {
        $data = ProductoControl::factory()->make([
            'tipo_control' => 'fertilizante',
            'fecha_ultima_aplicacion' => null, // Simula datos inválidos
        ])->toArray();

        $validator = $this->validate($data);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('fecha_ultima_aplicacion', $validator->errors()->toArray());
    }

}
