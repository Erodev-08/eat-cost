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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id('id_receta');
            $table->string('nombre_receta', 150);
            $table->string('slug')->unique();
            $table->longText('descripcion')->nullable();
            $table->text('procedimiento')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('porciones')->nullable();
            $table->foreignId('id_usuario')->nullable()->constrained('users', 'id_usuario')->onDelete('cascade');
            $table->date('fecha_creacion');
            $table->decimal('costo_total', 10, 2)->nullable();
            $table->decimal('precio_sugerido', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
