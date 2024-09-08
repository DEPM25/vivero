<?php

namespace Tests\Feature;

use App\Models\Finca;
use App\Models\Productor;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductorTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /* public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    } */

    /** @test */
    public function un_productor_tiene_todos_los_campos_obligatorios()
    {
        $this->expectException(QueryException::class);

        Productor::create([]);
    }

    /** @test */
    public function un_productor_puede_tener_varias_fincas()
    {
        $productor = Productor::factory()->create();
        $finca = Finca::factory()->create(['productor_id' => $productor->id]);

        $this->assertTrue($productor->fincas->contains($finca));
    }
}
