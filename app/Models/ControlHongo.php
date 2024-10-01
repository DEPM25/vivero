<?php

namespace App\Models;

use App\Models\ProductoControl;

class ControlHongo extends ProductoControl
{
    // Aquí puedes agregar métodos y propiedades adicionales para la clase ControlHongo
    protected $table = 'control_hongos';

    protected $fillable = [
        'periodo_carencia',
        'nombre_hongo'
    ];
}
