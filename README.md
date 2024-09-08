# Proyecto de Sistema para Viveros

Este proyecto está orientado a llevar un registro de los **Productores**, sus **Viveros**, las **Labores** realizadas, y los **Productos de Control** aplicados en las labores agrícolas. 

## Características del Sistema

- Registro de Productores: identificación, nombre, apellido, teléfono y correo.
- Registro de Fincas: identificadas por su número de catastro y municipio.
- Viveros: asociados a fincas y con diferentes tipos de cultivos.
- Labores: actividades agrícolas con fechas y descripciones.
- Productos de Control: fitosanitarios, plaguicidas, fertilizantes, con frecuencia de aplicación, periodo de carencia, etc.

## Requisitos

- [Laravel 11.x](https://laravel.com/docs/11.x)
- PHP 8.3+
- MySQL o MariaDB (u otro sistema de base de datos compatible)
- Composer

## Configuración del Proyecto

1. Clona el repositorio:

    ```bash
    git clone https://github.com/DEPM25/vivero
    cd vivero
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
    DB_DATABASE=vivero
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

## Escribir Pruebas Unitarias

Para escribir pruebas unitarias en Laravel, puedes generar tests con el siguiente comando

```bash
php artisan make:test ProductorTest
```

## Ejecutar las pruebas

Para ejecutar todas las pruebas del proyecto:
```bash
php artisan test
```

Para ejecutar una prueba especifica (en este caso `ProductorTest`):
```bash
php artisan test --filter ProductorTest
```