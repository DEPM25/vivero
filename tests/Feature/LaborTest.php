<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LaborTest extends TestCase
{
/** @test */
public function muestra_lista_de_labores()
    {
    // Crea un vivero y algunas labores
    $vivero = Vivero::factory()->create();
    Labor::factory()->create(['vivero_id' => $vivero->id, 'fecha_realizacion' => now(), 'descripcion' => 'Labor 1']);
    Labor::factory()->create(['vivero_id' => $vivero->id, 'fecha_realizacion' => now()->addDays(1), 'descripcion' => 'Labor 2']);

    // Realiza una solicitud GET a la ruta de listado de labores
    $response = $this->get(route('labores.index'));

    // Verifica que la respuesta sea exitosa
    $response->assertStatus(200);
    // Verifica que las labores estén en la vista
    $response->assertSee('Listado de Labores');
    $response->assertSee('Labor 1');
    $response->assertSee('Labor 2');
    }

/** @test */
public function puede_crear_una_nueva_labor()
    {
    // Crea un vivero
    $vivero = Vivero::factory()->create();

    // Realiza una solicitud POST para crear una nueva labor
    $response = $this->post(route('labores.store'), [
        'vivero_id' => $vivero->id,
        'fecha_realizacion' => now()->toDateString(),
        'descripcion' => 'Nueva Labor'
    ]);

    // Verifica que la labor fue creada
    $this->assertDatabaseHas('labores', [
        'vivero_id' => $vivero->id,
        'descripcion' => 'Nueva Labor'
    ]);

    // Verifica que se redirige a la lista de labores con un mensaje de éxito
    $response->assertRedirect(route('labores.index'));
    $response->assertSessionHas('success', 'Labor registrada con éxito.');
    }

/** @test */
public function valida_la_solicitud_de_creacion_de_labor()
    {
    // Intenta crear una nueva labor sin datos
    $response = $this->post(route('labores.store'), []);

    // Verifica que la respuesta contenga errores de validación
    $response->assertSessionHasErrors(['vivero_id', 'fecha_realizacion', 'descripcion']);
    }
}
