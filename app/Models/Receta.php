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
        )->withPivot('cantidad', 'merma_aplicada');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function calcularCostoTotal() {
        return $this->ingredientes->sum(function ($ingrediente) {
            $cantidad = $ingrediente->pivot->cantidad;
            $costo = $ingrediente->costo_unitario;
            $merma = $ingrediente->pivot->merma_aplicada ?? 0;
            return (($cantidad * $costo) * (1 + $merma));
        });
    }
}
