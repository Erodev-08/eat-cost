<?php

use App\Models\ConceptoFinanciero;
use App\Models\EncuestaModulo;
use App\Models\ProgresoEstudiante;
use App\Models\User;

it('shows a lesson without a quiz without crashing', function () {
    $user = User::factory()->create();

    $leccion = ConceptoFinanciero::create([
        'slug' => 'leccion-sin-quiz',
        'titulo' => 'Lección sin quiz',
        'icono' => 'ri-book-line',
        'badge_categoria' => 'Prueba',
        'orden' => 1,
        'descripcion' => 'Contenido de prueba',
        'formula' => null,
        'ejemplo' => null,
        'contenido_detallado' => [],
        'ejercicio_interactivo' => [],
        'quiz' => null,
    ]);

    $response = $this->actingAs($user)
        ->get(route('aprendizaje.show', $leccion->slug));

    $response->assertOk();
    $response->assertSee($leccion->titulo);
});

it('loads financial lessons from the application seeder', function () {
    $this->seed(Database\Seeders\ConceptosFinancierosSeeder::class);

    expect(ConceptoFinanciero::count())->toBeGreaterThan(0);
});

it('does not allow evaluating a locked lesson', function () {
    $user = User::factory()->create();

    $primera = ConceptoFinanciero::create([
        'slug' => 'primera-leccion',
        'titulo' => 'Primera lección',
        'descripcion' => 'Contenido de prueba',
        'orden' => 1,
        'quiz' => ['preguntas' => [['id' => 'p1', 'respuesta_correcta' => 0, 'opciones' => ['Sí']]]],
    ]);
    $segunda = ConceptoFinanciero::create([
        'slug' => 'segunda-leccion',
        'titulo' => 'Segunda lección',
        'descripcion' => 'Contenido de prueba',
        'orden' => 2,
        'quiz' => ['preguntas' => [['id' => 'p2', 'respuesta_correcta' => 0, 'opciones' => ['Sí']]]],
    ]);

    $response = $this->actingAs($user)->postJson(
        route('aprendizaje.evaluar', $segunda->slug),
        ['respuestas' => ['p2' => 0]]
    );

    $response->assertForbidden();
    expect(ProgresoEstudiante::where('id_usuario', $user->getKey())->count())->toBe(0);
});

it('does not expose correct answers when evaluating a lesson', function () {
    $user = User::factory()->create();
    $leccion = ConceptoFinanciero::create([
        'slug' => 'leccion-evaluable',
        'titulo' => 'Lección evaluable',
        'descripcion' => 'Contenido de prueba',
        'orden' => 1,
        'quiz' => ['preguntas' => [['id' => 'p1', 'respuesta_correcta' => 0, 'opciones' => ['Sí']]]],
    ]);

    $response = $this->actingAs($user)->postJson(
        route('aprendizaje.evaluar', $leccion->slug),
        ['respuestas' => ['p1' => 0]]
    );

    $response->assertOk()
        ->assertJsonMissingPath('retroalimentacion.0.respuesta_correcta');
});

it('requires a completed lesson before accepting its survey', function () {
    $user = User::factory()->create();
    $leccion = ConceptoFinanciero::create([
        'slug' => 'leccion-encuesta',
        'titulo' => 'Lección con encuesta',
        'descripcion' => 'Contenido de prueba',
        'orden' => 1,
        'quiz' => ['preguntas' => [['id' => 'p1', 'respuesta_correcta' => 0, 'opciones' => ['Sí']]]],
    ]);

    $response = $this->actingAs($user)->postJson(
        route('aprendizaje.encuesta', $leccion->slug),
        ['calificacion' => 5]
    );

    $response->assertUnprocessable();
    expect(EncuestaModulo::count())->toBe(0);
});

it('saves the required survey after completing a lesson', function () {
    $user = User::factory()->create();
    $leccion = ConceptoFinanciero::create([
        'slug' => 'leccion-encuesta-completa',
        'titulo' => 'Lección completada',
        'descripcion' => 'Contenido de prueba',
        'orden' => 1,
    ]);
    ProgresoEstudiante::create([
        'id_usuario' => $user->getKey(),
        'id_concepto' => $leccion->id_concepto,
        'completado' => true,
    ]);

    $response = $this->actingAs($user)->postJson(
        route('aprendizaje.encuesta', $leccion->slug),
        ['calificacion' => 4, 'comentario' => 'Muy claro']
    );

    $response->assertOk()->assertJson(['success' => true]);
    $this->assertDatabaseHas('encuestas_modulos', [
        'id_usuario' => $user->getKey(),
        'id_concepto' => $leccion->id_concepto,
        'calificacion' => 4,
        'comentario' => 'Muy claro',
    ]);
});