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
    use RefreshDatabase, WithFaker;

    // Método setUp para configurar el entorno de pruebas
    protected function setUp(): void
    {
        parent::setUp();

        // Desactivar el middleware de verificación CSRF
        $this->withoutMiddleware();
    }

    /** @test */
    public function puede_crear_un_productor_con_datos_validos()
    {
        // Arrancar - Preparar los datos de prueba
        $datosProductor = [
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '987654321',
            'correo' => 'juan.perez@ejemplo.com'
        ];

        // Actuar - Realizar la acción que queremos probar
        $response = $this->post(route('productores.store'), $datosProductor);

        // Afirmar - Verificar los resultados esperados
        $response->assertRedirect(route('productores.registro'));
        $response->assertSessionHas('success', 'Productor registrado con éxito.');

        // Verificar que el productor existe en la base de datos
        $this->assertDatabaseHas('productors', [
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '987654321',
            'correo' => 'juan.perez@ejemplo.com'
        ]);
    }

    /** @test */
    public function no_puede_crear_productor_con_documento_duplicado()
    {
        // Crear un productor inicial
        Productor::create([
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '987654321',
            'correo' => 'juan.perez@ejemplo.com'
        ]);

        // Intentar crear otro productor con el mismo documento
        $datosProductor = [
            'documento_identidad' => '12345678', // mismo documento
            'nombre' => 'María',
            'apellido' => 'López',
            'telefono' => '987654322',
            'correo' => 'maria.lopez@ejemplo.com'
        ];

        $response = $this->post(route('productores.store'), $datosProductor);

        $response->assertSessionHasErrors('documento_identidad');
    }

    /** @test */
    public function valida_formato_correcto_de_telefono()
    {
        // Datos con teléfono inválido
        $datosProductor = [
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '123', // teléfono inválido
            'correo' => 'juan.perez@ejemplo.com'
        ];

        $response = $this->post(route('productores.store'), $datosProductor);

        $response->assertSessionHasErrors('telefono');
    }

    /** @test */
    public function valida_que_nombre_y_apellido_no_contengan_numeros()
    {
        // Datos con números en nombre y apellido
        $datosProductor = [
            'documento_identidad' => '12345678',
            'nombre' => 'Juan123',
            'apellido' => 'Pérez456',
            'telefono' => '987654321',
            'correo' => 'juan.perez@ejemplo.com'
        ];

        $response = $this->post(route('productores.store'), $datosProductor);

        $response->assertSessionHasErrors(['nombre', 'apellido']);
    }

    /** @test */
    public function valida_formato_correcto_de_correo()
    {
        // Datos con correo inválido
        $datosProductor = [
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '987654321',
            'correo' => 'correo-invalido' // correo inválido
        ];

        $response = $this->post(route('productores.store'), $datosProductor);

        $response->assertSessionHasErrors('correo');
    }

    /** @test */
    public function no_puede_crear_productor_con_correo_duplicado()
    {
        // Crear un productor inicial
        Productor::create([
            'documento_identidad' => '12345678',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '987654321',
            'correo' => 'juan.perez@ejemplo.com'
        ]);

        // Intentar crear otro productor con el mismo correo
        $datosProductor = [
            'documento_identidad' => '87654321',
            'nombre' => 'María',
            'apellido' => 'López',
            'telefono' => '987654322',
            'correo' => 'juan.perez@ejemplo.com' // mismo correo
        ];

        $response = $this->post(route('productores.store'), $datosProductor);

        $response->assertSessionHasErrors('correo');
    }

    /** @test */
    public function requiere_todos_los_campos_obligatorios()
    {
        // Enviar datos vacíos
        $response = $this->post(route('productores.store'), []);

        $response->assertSessionHasErrors([
            'documento_identidad',
            'nombre',
            'apellido',
            'telefono',
            'correo'
        ]);
    }
}
