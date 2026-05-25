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
        Schema::create('profile', function (Blueprint $table) {
            $table->id('id_profile');
            $table->string('profile')->nullable();  // Para la foto de perfil
            $table->string('cover_image')->nullable();  // Para la imagen de portada
            $table->foreignId('id_user')->constrained('users', 'id_usuario')->onDelete('cascade');
            $table->timestamps();
            
            // Índice único para evitar duplicados (un usuario solo tiene un perfil)
            $table->unique('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
