<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetaCalc extends Model
{
    protected $table = 'recetas_elaboradas';

    protected $primaryKey = 'id_receta_elaborada';

    protected $fillable = [

    'id_receta',
    'id_usuario',

    'cantidad_porciones',

    'mano_obra',
    'costos_indirectos',
    'gastos_operacion',

    'precio_por_porcion',

    'utilidad_deseada',

    'costo_neto',
    'costo_produccion',
    'costo_total',

    'costo_por_porcion',

    'precio_sin_iva',

    'utilidad_real',

    'ganancia_por_porcion',
    'ganancia_total',

    'utilidad_real_porcentaje',

    'costo_objetivo',
    'diferencia_objetivo',

    'interpretacion',

    'fecha_calculo',

];

    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta');
    }

    public function ingredientes()
    {
        return $this->hasMany(RecetaCalcIngrediente::class, 'id_receta_elaborada');
    }
}
