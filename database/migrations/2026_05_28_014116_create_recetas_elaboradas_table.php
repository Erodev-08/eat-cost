<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('recetas_elaboradas', function (Blueprint $table) {
            $table->id('id_receta_elaborada');

            $table->foreignId('id_receta')
                ->constrained('recetas', 'id_receta')
                ->cascadeOnDelete();

            $table->foreignId('id_usuario')
                ->nullable()
                ->constrained('users', 'id_usuario')
                ->nullOnDelete();

            $table->decimal('mano_obra', 10, 2)->default(0);
            $table->decimal('costos_indirectos', 10, 2)->default(0);
            $table->decimal('gastos_operacion', 10, 2)->default(0);
            $table->decimal('precio_venta', 10, 2)->default(0);
            $table->decimal('utilidad_deseada', 5, 2)->default(0);

            $table->decimal('costo_neto', 10, 2)->default(0);
            $table->decimal('costo_produccion', 10, 2)->default(0);
            $table->decimal('costo_total', 10, 2)->default(0);
            $table->decimal('precio_sin_iva', 10, 2)->default(0);
            $table->decimal('utilidad_real', 10, 2)->default(0);
            $table->decimal('utilidad_real_porcentaje', 5, 2)->default(0);
            $table->decimal('costo_objetivo', 10, 2)->default(0);
            $table->decimal('diferencia_objetivo', 10, 2)->default(0);

            $table->text('interpretacion')->nullable();
            $table->timestamp('fecha_calculo')->useCurrent();

            $table->timestamps();
        });
    }
};
