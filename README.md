# Proyecto de Sistema para Viveros

Este proyecto está orientado a llevar un registro de los **Productores**, sus **Viveros**, las **Labores** realizadas, y los **Productos de Control** aplicados en las labores agrícolas. 

## Características del Sistema

- Registro de Productores: identificación, nombre, apellido, teléfono y correo.
- Registro de Fincas: identificadas por su número de catastro y municipio.
- Viveros: asociados a fincas y con diferentes tipos de cultivos.
- Labores: actividades agrícolas con fechas y descripciones.
- Productos de Control: fitosanitarios, plaguicidas, fertilizantes, con frecuencia de aplicación, periodo de carencia, etc.

## Requisitos

- [Laravel 9.x](https://laravel.com/docs/9.x)
- PHP 8.1+
- MySQL o MariaDB (u otro sistema de base de datos compatible)
- Composer

## Configuración del Proyecto

1. Clona el repositorio:

    ```bash
    git clone https://github.com/tu-usuario/sistema-viveros.git
    cd sistema-viveros
    ```

2. Instala las dependencias de PHP:

    ```bash
    composer install
    ```

3. Crea una copia del archivo `.env` y configura las credenciales de la base de datos:

    ```bash
    cp .env.example .env
    ```

    Luego, abre el archivo `.env` y configura las variables de entorno para tu base de datos:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sistema_viveros
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

4. Ejecuta las migraciones para crear las tablas en la base de datos:

    ```bash
    php artisan migrate
    ```

## Pruebas Unitarias

### Configurar la base de datos de pruebas

Laravel usa una base de datos separada para las pruebas. Para configurarla:

1. Crea un archivo `.env.testing` copiando el contenido de `.env`:

    ```bash
    cp .env .env.testing
    ```

2. Abre el archivo `.env.testing` y configura las credenciales de la base de datos de pruebas:

    ```env
    DB_CONNECTION=mysql
    DB_DATABASE=nombre_base_datos_pruebas
    DB_USERNAME=usuario_pruebas
    DB_PASSWORD=contraseña_pruebas
    ```

### Crear Factories

Para generar datos ficticios en las pruebas, necesitas crear **factories** para los modelos.

#### Crear la Factory de Productor

1. Ejecuta el siguiente comando para crear una factory para **Productor**:

    ```bash
    php artisan make:factory ProductorFactory --model=Productor
    ```

2. Configura la factory en `database/factories/ProductorFactory.php`:

    ```php
    use App\Models\Productor;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class ProductorFactory extends Factory
    {
        protected $model = Productor::class;

        public function definition()
        {
            return [
                'documento_identidad' => $this->faker->unique()->numerify('#########'),
                'nombre' => $this->faker->firstName,
                'apellido' => $this->faker->lastName,
                'telefono' => $this->faker->phoneNumber,
                'correo' => $this->faker->safeEmail,
            ];
        }
    }
    ```

#### Crear la Factory de Finca

1. Ejecuta el siguiente comando para crear una factory para **Finca**:

    ```bash
    php artisan make:factory FincaFactory --model=Finca
    ```

2. Configura la factory en `database/factories/FincaFactory.php`:

    ```php
    use App\Models\Finca;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class FincaFactory extends Factory
    {
        protected $model = Finca::class;

        public function definition()
        {
            return [
                'numero_catastro' => $this->faker->unique()->numerify('#########'),
                'municipio' => $this->faker->city,
                'productor_id' => \App\Models\Productor::factory(), // Relacionar con un productor
            ];
        }
    }
    ```

### Verificar Relaciones

Asegúrate de que el modelo **Finca** tenga una relación `belongsTo` con **Productor** en el archivo `app/Models/Finca.php`:

```php
class Finca extends Model
{
    protected $fillable = [
        'numero_catastro',
        'municipio',
        'productor_id',
    ];

    public function productor()
    {
        return $this->belongsTo(Productor::class);
    }
}
```