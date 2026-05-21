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
        Schema::create('mermas', function (Blueprint $table) {
             $table->id('id_merma');
            $table->foreignId('id_ingrediente')->constrained('ingredientes', 'id_ingrediente')->onDelete('cascade');
            $table->enum('tipo_merma', ['limpieza', 'coccion', 'almacenamiento']);
            $table->decimal('porcentaje', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mermas');
    }
};
