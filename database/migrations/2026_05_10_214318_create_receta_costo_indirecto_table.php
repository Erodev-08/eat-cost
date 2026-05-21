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
        Schema::create('receta_costo_indirecto', function (Blueprint $table) {
            $table->foreignId('id_receta')->constrained('recetas', 'id_receta')->onDelete('cascade');
            $table->foreignId('id_costo_indirecto')->constrained('costos_indirectos', 'id_costo_indirecto')->onDelete('restrict');
            $table->decimal('cantidad_aplicada', 10, 2);
            $table->primary(['id_receta', 'id_costo_indirecto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta_costo_indirecto');
    }
};
