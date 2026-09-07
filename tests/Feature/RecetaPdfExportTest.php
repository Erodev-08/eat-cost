<?php

use App\Models\Receta;
use App\Models\RecetaCalc;
use App\Models\User;

it('generates a pdf export for a recipe report', function () {
    $user = User::factory()->create();

    $receta = Receta::create([
        'nombre_receta' => 'Paella',
        'slug' => 'paella',
        'porciones' => 1,
        'cantidad_porciones' => 10,
        'tipo_porcion' => 'porciones',
        'id_usuario' => $user->id,
        'descripcion' => 'Prueba',
        'procedimiento' => 'Preparación',
        'fecha_creacion' => now()->toDateString(),
    ]);

    $recetaElaborada = RecetaCalc::create([
        'id_receta' => $receta->id_receta,
        'id_usuario' => $user->id,
        'cantidad_porciones' => 10,
        'mano_obra' => 50,
        'costos_indirectos' => 25,
        'gastos_operacion' => 15,
        'precio_por_porcion' => 100,
        'utilidad_deseada' => 30,
        'costo_neto' => 500,
        'costo_produccion' => 575,
        'costo_total' => 590,
        'costo_por_porcion' => 59,
        'precio_sin_iva' => 86.20,
        'utilidad_real' => 272,
        'ganancia_por_porcion' => 27.20,
        'ganancia_total' => 272,
        'utilidad_real_porcentaje' => 31.57,
        'costo_objetivo' => 60.34,
        'diferencia_objetivo' => -1.34,
        'interpretacion' => 'Reporte de prueba',
    ]);

    $response = $this->get(route('recetas.elaboradas.document', $recetaElaborada));

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/pdf');
});

it('generates an excel export with a formatted report layout', function () {
    $user = User::factory()->create();

    $receta = Receta::create([
        'nombre_receta' => 'Paella',
        'slug' => 'paella',
        'porciones' => 1,
        'cantidad_porciones' => 10,
        'tipo_porcion' => 'porciones',
        'id_usuario' => $user->id,
        'descripcion' => 'Receta de prueba con sabor mediterráneo',
        'procedimiento' => 'Preparación',
        'fecha_creacion' => now()->toDateString(),
    ]);

    $recetaElaborada = RecetaCalc::create([
        'id_receta' => $receta->id_receta,
        'id_usuario' => $user->id,
        'cantidad_porciones' => 10,
        'mano_obra' => 50,
        'costos_indirectos' => 25,
        'gastos_operacion' => 15,
        'precio_por_porcion' => 100,
        'utilidad_deseada' => 30,
        'costo_neto' => 500,
        'costo_produccion' => 575,
        'costo_total' => 590,
        'costo_por_porcion' => 59,
        'precio_sin_iva' => 86.20,
        'utilidad_real' => 272,
        'ganancia_por_porcion' => 27.20,
        'ganancia_total' => 272,
        'utilidad_real_porcentaje' => 31.57,
        'costo_objetivo' => 60.34,
        'diferencia_objetivo' => -1.34,
        'interpretacion' => 'Reporte de prueba',
    ]);

    $response = $this->get(route('recetas.elaboradas.excel', $recetaElaborada));

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/vnd.ms-excel; charset=UTF-8');
    $response->assertSee('Paella');
    $response->assertSee('Resumen financiero');
    $response->assertSee('Detalle de ingredientes');

    $previewResponse = $this->get(route('recetas.elaboradas.excel', $recetaElaborada) . '?preview=1');

    $previewResponse->assertOk();
    $previewResponse->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    $previewResponse->assertSee('Paella');
    $previewResponse->assertSee('Detalle de ingredientes');
});
