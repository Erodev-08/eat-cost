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
        Schema::create('receta_ingrediente', function (Blueprint $table) {
            $table->foreignId('id_receta')->constrained('recetas', 'id_receta')->onDelete('cascade');
            $table->foreignId('id_ingrediente')->constrained('ingredientes', 'id_ingrediente')->onDelete('restrict');
            $table->decimal('cantidad', 10, 2)->nullable();
            $table->decimal('merma_aplicada', 5, 2)->default(0);
            $table->primary(['id_receta', 'id_ingrediente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta_ingrediente');
    }
};
