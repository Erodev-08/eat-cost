<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;
    protected $fillable = [
    'nombre',
    'unidad_medida',
    'presentacion_cantidad',
    'presentacion_unidad',
    'costo_presentacion',
    ];
    protected $primaryKey = 'id_ingrediente';
}
