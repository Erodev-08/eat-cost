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
        Schema::create('reportes_rentabilidad', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->foreignId('id_receta')->constrained('recetas', 'id_receta')->onDelete('cascade');
            $table->decimal('costo_total', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('margen_ganancia', 5, 2); // en porcentaje
            $table->decimal('punto_equilibrio', 10, 2)->nullable();
            $table->date('fecha_reporte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_rentabilidad');
    }
};
