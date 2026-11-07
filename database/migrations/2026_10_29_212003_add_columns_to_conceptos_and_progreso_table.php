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
        Schema::table('conceptos_financieros', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id_concepto');
            $table->string('icono', 50)->default('ri-book-open-line')->after('titulo');
            $table->string('badge_categoria', 50)->default('Finanzas')->after('icono');
            $table->integer('orden')->default(1)->after('badge_categoria');
            $table->json('contenido_detallado')->nullable()->after('ejemplo');
            $table->json('ejercicio_interactivo')->nullable()->after('contenido_detallado');
            $table->json('quiz')->nullable()->after('ejercicio_interactivo');
        });

        Schema::table('progreso_estudiantes', function (Blueprint $table) {
            $table->integer('puntaje_quiz')->nullable()->after('completado');
            $table->json('respuestas_usuario')->nullable()->after('puntaje_quiz');
            $table->integer('intentos')->default(0)->after('respuestas_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progreso_estudiantes', function (Blueprint $table) {
            $table->dropColumn(['puntaje_quiz', 'respuestas_usuario', 'intentos']);
        });

        Schema::table('conceptos_financieros', function (Blueprint $table) {
            $table->dropColumn(['slug', 'icono', 'badge_categoria', 'orden', 'contenido_detallado', 'ejercicio_interactivo', 'quiz']);
        });
    }
};
