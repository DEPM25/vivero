<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;

    protected $fillable = ['numero_catastro', 'municipio', 'productor_id', 'nombre', 'ubicacion'];

    public function productor() {
        return $this->belongsTo(Productor::class);
    }
    
    public function viveros() {
        return $this->hasMany(Vivero::class);
    }
}
