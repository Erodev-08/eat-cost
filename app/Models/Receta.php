<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingrediente;
use Override;

class Receta extends Model
{

    use HasFactory;

    protected $fillable = [
        'nombre_receta',
        'slug',
        'porciones',
        'id_usuario',
        'fecha_creacion',
        'descripcion',
        'procedimiento',
        'imagen'
    ];

    protected $primaryKey = 'id_receta';

    public function ingredientes() {
        return $this->belongsToMany(
            Ingrediente::class,
            'receta_ingrediente',
            'id_receta',
            'id_ingrediente'
        )->withPivot('cantidad', 'unidad_medida', 'merma_aplicada');
    }

    public function getRouteKeyName(){
        return 'slug';
    }
    public function elaboradas()
    {
        return $this->hasMany(RecetaCalc::class, 'id_receta');
    }
}
