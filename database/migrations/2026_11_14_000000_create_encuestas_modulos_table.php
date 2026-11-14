<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encuestas_modulos', function (Blueprint $table) {
            $table->id('id_encuesta');
            $table->foreignId('id_usuario')->constrained('users', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_concepto')->constrained('conceptos_financieros', 'id_concepto')->onDelete('cascade');
            $table->unsignedTinyInteger('calificacion');
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->unique(['id_usuario', 'id_concepto'], 'unique_encuesta_modulo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encuestas_modulos');
    }
};
