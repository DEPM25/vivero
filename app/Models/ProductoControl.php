<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'registro_ica',
        'nombre_producto',
        'frecuencia_aplicacion',
        'valor',
        'tipo_control',
        'nombre_hongo',
        'periodo_carencia',
        'fecha_ultima_aplicacion'
    ];
}
