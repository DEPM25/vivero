<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_controls', function (Blueprint $table) {
            $table->id();
            $table->string('registro_ica');
            $table->string('nombre_producto');
            $table->integer('frecuencia_aplicacion');
            $table->decimal('valor', 8, 2);
            $table->enum('tipo_control', ['Hongo', 'Plaga', 'Fertilizante']);
            
            // Campos adicionales dependiendo del tipo de control
            $table->string('nombre_hongo')->nullable();
            $table->integer('periodo_carencia')->nullable();
            $table->date('fecha_ultima_aplicacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_controls');
    }
};
