<?php

use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\User;

test('editing a recipe synchronizes the presentation unit with the ingredient unit', function () {
    $user = User::create([
        'nombre' => 'Ana',
        'email' => 'ana@example.com',
        'contrasena' => bcrypt('password'),
        'institution' => 'Test School',
        'rol' => 'estudiante',
    ]);

    $receta = Receta::create([
        'nombre_receta' => 'Sopa de verduras',
        'slug' => 'sopa-de-verduras',
        'cantidad_porciones' => 4,
        'tipo_porcion' => 'porciones',
        'id_usuario' => $user->id_usuario,
        'fecha_creacion' => now()->toDateString(),
        'descripcion' => 'Descripcion de prueba',
        'procedimiento' => 'Preparar',
    ]);

    $response = $this->actingAs($user)->put("/receta/{$receta->slug}", [
        'nombre_receta' => 'Sopa de verduras',
        'cantidad_porciones' => 4,
        'tipo_porcion' => 'porciones',
        'descripcion' => 'Descripcion de prueba',
        'procedimiento' => 'Preparar',
        'ingredientes' => [
            [
                'nombre' => 'Zanahoria',
                'cantidad' => 250,
                'unidad_medida' => 'gr',
                'presentacion_cantidad' => 1,
                'presentacion_unidad' => 'kg',
                'costo_presentacion' => 18.5,
            ],
        ],
    ]);

    $response->assertRedirect();

    $receta->refresh()->load('ingredientes');

    expect($receta->ingredientes)->toHaveCount(1)
        ->and($receta->ingredientes->first()->unidad_medida)->toBe('gr')
        ->and($receta->ingredientes->first()->presentacion_unidad)->toBe('gr');
});

test('editing another recipe does not overwrite shared ingredient costing data', function () {
    $user = User::factory()->create();
    $ingrediente = Ingrediente::create([
        'nombre' => 'Zanahoria',
        'unidad_medida' => 'gr',
        'presentacion_cantidad' => 1,
        'presentacion_unidad' => 'gr',
        'costo_presentacion' => 18.5,
    ]);

    $receta = Receta::create([
        'nombre_receta' => 'Ensalada',
        'slug' => 'ensalada',
        'cantidad_porciones' => 2,
        'tipo_porcion' => 'porciones',
        'id_usuario' => $user->id_usuario,
        'fecha_creacion' => now()->toDateString(),
        'descripcion' => 'Descripcion',
        'procedimiento' => 'Preparar',
    ]);

    $response = $this->actingAs($user)->put("/receta/{$receta->slug}", [
        'nombre_receta' => 'Ensalada',
        'cantidad_porciones' => 2,
        'tipo_porcion' => 'porciones',
        'descripcion' => 'Descripcion',
        'procedimiento' => 'Preparar',
        'ingredientes' => [[
            'nombre' => 'Zanahoria',
            'cantidad' => 100,
            'unidad_medida' => 'gr',
            'presentacion_cantidad' => 2,
            'presentacion_unidad' => 'kg',
            'costo_presentacion' => 40,
        ]],
    ]);

    $response->assertRedirect();
    expect((float) $ingrediente->refresh()->costo_presentacion)->toBe(18.5);
});
