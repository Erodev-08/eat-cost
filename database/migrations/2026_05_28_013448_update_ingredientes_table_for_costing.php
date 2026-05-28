<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ingredientes', function (Blueprint $table) {
            $table->decimal('presentacion_cantidad', 10, 2)->nullable()->after('unidad_medida');
            $table->string('presentacion_unidad', 30)->nullable()->after('presentacion_cantidad');
            $table->decimal('costo_presentacion', 10, 2)->nullable()->after('presentacion_unidad');
        });
    }

    public function down(): void
    {
        Schema::table('ingredientes', function (Blueprint $table) {
            $table->dropColumn([
                'presentacion_cantidad',
                'presentacion_unidad',
                'costo_presentacion',
            ]);
        });
    }
};
