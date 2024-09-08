<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivero extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'tipo_cultivo', 'finca_id'];

    public function finca() {
        return $this->belongsTo(Finca::class);
    }

    public function labores() {
        return $this->hasMany(Labor::class);
    }
}
