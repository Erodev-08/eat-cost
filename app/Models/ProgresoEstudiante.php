<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgresoEstudiante extends Model
{
    protected $table = 'progreso_estudiantes';
    protected $primaryKey = 'id_progreso';

    protected $fillable = [
        'id_usuario',
        'id_concepto',
        'completado',
        'fecha_completado',
        'puntaje_quiz',
        'respuestas_usuario',
        'quiz_generado',
        'intentos',
    ];

    protected $casts = [
        'completado' => 'boolean',
        'fecha_completado' => 'date',
        'respuestas_usuario' => 'array',
        'quiz_generado' => 'array',
        'puntaje_quiz' => 'integer',
        'intentos' => 'integer',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function concepto(): BelongsTo
    {
        return $this->belongsTo(ConceptoFinanciero::class, 'id_concepto', 'id_concepto');
    }
}
