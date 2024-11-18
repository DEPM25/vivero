<?php

namespace Tests\Feature;

use App\Models\Finca;
use App\Models\Vivero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViveroTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_crear_vivero()
    {
        $finca = Finca::factory()->create();
        
        $response = $this->post('/viveros', [
            'codigo' => 'VIV001',
            'tipo_cultivo' => 'Flores',
            'finca_id' => $finca->id
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('viveros', [
            'codigo' => 'VIV001',
            'tipo_cultivo' => 'Flores'
        ]);
    }

    public function test_codigo_debe_ser_unico()
    {
        $finca = Finca::factory()->create();
        
        Vivero::create([
            'codigo' => 'VIV001',
            'tipo_cultivo' => 'Flores',
            'finca_id' => $finca->id
        ]);

        $response = $this->post('/viveros', [
            'codigo' => 'VIV001',
            'tipo_cultivo' => 'Frutas',
            'finca_id' => $finca->id
        ]);

        $response->assertSessionHasErrors('codigo');
    }

    public function test_puede_listar_viveros()
    {
        $finca = Finca::factory()->create();
        $vivero = Vivero::factory()->create([
            'finca_id' => $finca->id
        ]);

        $response = $this->get('/viveros');
        
        $response->assertStatus(200);
        $response->assertSee($vivero->codigo);
        $response->assertSee($vivero->tipo_cultivo);
    }
}