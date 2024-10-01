<?php

namespace App\Models;

use App\Models\ProductoControl;

class ControlPlaga extends ProductoControl
{
    protected $table = 'control_plagas';

    protected $fillable = [
        'periodo_carencia',
    ];
}
