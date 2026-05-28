<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetaCalcIngrediente extends Model
{
    protected $table = 'receta_elaborada_ingredientes';
    protected $fillable = [
    'id_receta_elaborada',
    'id_ingrediente',
    'cantidad_usada',
    'unidad_usada',
    'peso_bruto',
    'peso_util',
    'merma_porcentaje',
    'rendimiento',
    'costo_real',
    'costo_unitario_base',
    'costo_receta',
    ];

    public function recetaElaborada()
    {
        return $this->belongsTo(RecetaCalc::class, 'id_receta_elaborada');
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class, 'id_ingrediente');
    }
}
