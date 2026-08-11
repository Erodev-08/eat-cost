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
        Schema::table('recetas_elaboradas', function (Blueprint $table) {

            // Cantidad de porciones producidas
            $table->unsignedInteger('cantidad_porciones')
                  ->after('id_usuario');

            // Precio de venta por porción
            $table->decimal('precio_por_porcion', 10, 2)
                  ->after('gastos_operacion');

            // Costo por porción
            $table->decimal('costo_por_porcion', 10, 2)
                  ->after('costo_total');

            // Ganancia por porción
            $table->decimal('ganancia_por_porcion', 10, 2)
                  ->after('utilidad_real');

            // Ganancia total de toda la producción
            $table->decimal('ganancia_total', 10, 2)
                  ->after('ganancia_por_porcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recetas_elaboradas', function (Blueprint $table) {

            $table->dropColumn([
                'cantidad_porciones',
                'precio_por_porcion',
                'costo_por_porcion',
                'ganancia_por_porcion',
                'ganancia_total',
            ]);

        });
    }
};