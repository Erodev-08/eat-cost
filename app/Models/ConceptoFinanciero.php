<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConceptoFinanciero extends Model
{
    protected $table = 'conceptos_financieros';
    protected $primaryKey = 'id_concepto';

    protected $fillable = [
        'slug',
        'titulo',
        'icono',
        'badge_categoria',
        'orden',
        'descripcion',
        'formula',
        'ejemplo',
        'contenido_detallado',
        'ejercicio_interactivo',
        'quiz',
    ];

    protected $casts = [
        'contenido_detallado' => 'array',
        'ejercicio_interactivo' => 'array',
        'quiz' => 'array',
    ];

    public function progresos(): HasMany
    {
        return $this->hasMany(ProgresoEstudiante::class, 'id_concepto', 'id_concepto');
    }

    public function progresoParaUsuario($idUsuario)
    {
        return $this->hasOne(ProgresoEstudiante::class, 'id_concepto', 'id_concepto')
            ->where('id_usuario', $idUsuario);
    }
}
