<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progreso_estudiantes', function (Blueprint $table) {
            $table->id('id_progreso');
            $table->foreignId('id_usuario')->constrained('users', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_concepto')->constrained('conceptos_financieros', 'id_concepto')->onDelete('cascade');
            $table->boolean('completado')->default(false);
            $table->date('fecha_completado')->nullable();
            $table->unique(['id_usuario', 'id_concepto'], 'unique_progreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progreso_estudiantes');
    }
};
