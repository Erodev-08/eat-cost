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
        'mano_obra',
        'costos_indirectos',
        'gastos_operacion',
        'precio_venta',
        'utilidad_deseada',
        'costo_neto',
        'costo_produccion',
        'costo_total',
        'precio_sin_iva',
        'utilidad_real',
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
