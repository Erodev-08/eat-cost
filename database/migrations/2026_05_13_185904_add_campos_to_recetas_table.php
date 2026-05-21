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
        Schema::table('recetas', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('nombre_receta');
            $table->text('procedimiento')->nullable()->after('descripcion');
            $table->string('imagen')->nullable()->after('procedimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('procedimiento');
            $table->dropColumn('imagen');

        });
    }
};
