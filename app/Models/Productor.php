<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    use HasFactory;

    protected $fillable = ['documento_identidad', 'nombre', 'apellido', 'correo', 'telefono'];

    public function fincas() {
        return $this->hasMany(Finca::class);
    }    
}
