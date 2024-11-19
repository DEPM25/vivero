<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoControl extends Model
{
    use HasFactory;

    protected $table = 'producto_controls';

    public static function rules()
    {
        return [
            'registro_ica' => 'required|regex:/^[A-Z0-9]{3,10}$/', // Validación para el formato del registro ICA
            'nombre_producto' => 'required|string|max:255', // Validación para el nombre del producto
            'frecuencia_aplicacion' => 'required|integer|min:1', // Frecuencia de aplicación en días, mínimo 1
            'valor' => 'required|numeric|min:0', // Valor debe ser un número positivo
            'tipo_control' => 'required|in:hongo,plaga,fertilizante', // Valores permitidos para el tipo de control
            'nombre_hongo' => 'nullable|required_if:tipo_control,hongo|string|max:255', // Campo requerido si el tipo de control es "hongo"
            'periodo_carencia' => 'nullable|required_if:tipo_control,plaga|integer|min:0', // Campo requerido si el tipo de control es "plaga"
            'fecha_ultima_aplicacion' => 'nullable|required_if:tipo_control,fertilizante|date', // Campo requerido si el tipo de control es "fertilizante"
        ];
    }


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
