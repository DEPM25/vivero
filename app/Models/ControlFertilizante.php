<?php

namespace App\Models;

use App\Models\ProductoControl;

class ControlFertilizante extends ProductoControl
{
    protected $table = 'control_fertilizantes';

    protected $fillable = [
        'ultima_aplicacion',
    ];
}
