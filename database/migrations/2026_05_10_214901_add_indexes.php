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
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });

        Schema::table('recetas', function (Blueprint $table) {
            $table->index('id_usuario');
            $table->index('fecha_creacion');
        });

        Schema::table('ingredientes', function (Blueprint $table) {
            $table->index('nombre');
        });

        Schema::table('reportes_rentabilidad', function (Blueprint $table) {
            $table->index('fecha_reporte');
        });

        Schema::table('progreso_estudiantes', function (Blueprint $table) {
            $table->index('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
        });

        Schema::table('recetas', function (Blueprint $table) {
            $table->dropIndex(['id_usuario']);
            $table->dropIndex(['fecha_creacion']);
        });

        Schema::table('ingredientes', function (Blueprint $table) {
            $table->dropIndex(['nombre']);
        });

        Schema::table('reportes_rentabilidad', function (Blueprint $table) {
            $table->dropIndex(['fecha_reporte']);
        });

        Schema::table('progreso_estudiantes', function (Blueprint $table) {
            $table->dropIndex(['id_usuario']);
        });
    }
};
