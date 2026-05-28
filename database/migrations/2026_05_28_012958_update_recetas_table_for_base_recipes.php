<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->dropColumn(['costo_total', 'precio_sugerido']);
        });
    }

    public function down(): void
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->decimal('costo_total', 10, 2)->nullable();
            $table->decimal('precio_sugerido', 10, 2)->nullable();
        });
    }
};
