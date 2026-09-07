<?php

use App\Models\Receta;
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
