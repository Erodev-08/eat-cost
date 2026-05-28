<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('receta_elaborada_ingredientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_receta_elaborada')
                ->constrained('recetas_elaboradas', 'id_receta_elaborada')
                ->cascadeOnDelete();

            $table->foreignId('id_ingrediente')
                ->constrained('ingredientes', 'id_ingrediente')
                ->restrictOnDelete();

            $table->decimal('cantidad_usada', 10, 2)->default(0);
            $table->string('unidad_usada', 30)->nullable();

            $table->decimal('peso_bruto', 10, 2)->nullable();
            $table->decimal('peso_util', 10, 2)->nullable();
            $table->decimal('merma_porcentaje', 5, 2)->default(0);
            $table->decimal('rendimiento', 8, 4)->default(1);

            $table->decimal('costo_real', 10, 2)->default(0);
            $table->decimal('costo_unitario_base', 10, 4)->default(0);
            $table->decimal('costo_receta', 10, 2)->default(0);

            $table->timestamps();
        });
    }
};
