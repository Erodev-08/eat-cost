<?php

use App\Models\Receta;
use App\Models\RecetaCalc;
use App\Models\User;

it('does not expose another users calculation report', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();

    $receta = Receta::create([
        'nombre_receta' => 'Receta privada',
        'slug' => 'receta-privada',
        'cantidad_porciones' => 4,
        'tipo_porcion' => 'porciones',
        'id_usuario' => $owner->id_usuario,
        'fecha_creacion' => now()->toDateString(),
    ]);

    $calculo = RecetaCalc::create([
        'id_receta' => $receta->id_receta,
        'id_usuario' => $owner->id_usuario,
        'cantidad_porciones' => 4,
        'mano_obra' => 0,
        'costos_indirectos' => 0,
        'gastos_operacion' => 0,
        'precio_por_porcion' => 1,
        'utilidad_deseada' => 0,
        'costo_neto' => 0,
        'costo_produccion' => 0,
        'costo_total' => 0,
        'costo_por_porcion' => 0,
        'precio_sin_iva' => 1,
        'utilidad_real' => 0,
        'ganancia_por_porcion' => 1,
        'ganancia_total' => 4,
        'utilidad_real_porcentaje' => 100,
        'costo_objetivo' => 1,
        'diferencia_objetivo' => -1,
    ]);

    $response = $this->actingAs($otherUser)
        ->get(route('recetas.elaboradas.show', $calculo));

    $response->assertForbidden();
});

it('requires authentication for calculation reports', function () {
    $response = $this->get(route('recetas.elaboradas.index'));

    $response->assertRedirect(route('login'));
});