<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EncuestaModulo extends Model
{
    protected $table = 'encuestas_modulos';
    protected $primaryKey = 'id_encuesta';

    protected $fillable = [
        'id_usuario',
        'id_concepto',
        'calificacion',
        'comentario',
    ];

    protected $casts = [
        'calificacion' => 'integer',
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
