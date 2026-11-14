<?php

namespace App\Http\Controllers;

use App\Models\ConceptoFinanciero;
use App\Models\EncuestaModulo;
use App\Models\ProgresoEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AprendizajeController extends Controller
{
    /**
     * Muestra la ruta de aprendizaje con todas las lecciones y estado de progreso.
     */
    public function index()
    {
        $userId = Auth::id();
        $lecciones = ConceptoFinanciero::orderBy('orden', 'asc')->get();

        // Obtener los progresos del usuario actual
        $progresos = ProgresoEstudiante::where('id_usuario', $userId)
            ->get()
            ->keyBy('id_concepto');

        // Determinar desbloqueo secuencial (la primera siempre abierta, las demás si la anterior se completó)
        $completadasCount = 0;
        $anteriorCompletada = true;

        foreach ($lecciones as $index => $leccion) {
            $progreso = $progresos->get($leccion->id_concepto);
            $estaCompletada = $progreso && $progreso->completado;
            
            if ($estaCompletada) {
                $completadasCount++;
            }

            // Desbloqueada si es la primera o si la anterior fue completada
            $leccion->desbloqueada = ($index === 0) || $anteriorCompletada;
            $leccion->progreso = $progreso;
            $leccion->esta_completada = $estaCompletada;

            $anteriorCompletada = $estaCompletada;
        }

        $totalLecciones = $lecciones->count();
        $porcentajeProgreso = $totalLecciones > 0 ? round(($completadasCount / $totalLecciones) * 100) : 0;

        return view('aprendizaje.index', compact('lecciones', 'completadasCount', 'totalLecciones', 'porcentajeProgreso'));
    }

    /**
     * Muestra la lección teórica y su ejercicio práctico interactivo.
     */
    public function show($slug)
    {
        $userId = Auth::id();
        $leccion = ConceptoFinanciero::where('slug', $slug)->firstOrFail();
        $progresos = ProgresoEstudiante::where('id_usuario', $userId)
            ->get()
            ->keyBy('id_concepto');

        if (!$this->leccionEstaDesbloqueada($leccion, $userId)) {
            return redirect()->route('aprendizaje.index')->with('status_error', 'Debes completar las lecciones previas para desbloquear este módulo.');
        }

        $progreso = $progresos->get($leccion->id_concepto)
            ?? new ProgresoEstudiante([
                'id_usuario' => $userId,
                'id_concepto' => $leccion->id_concepto,
            ]);

        // Si ya hay un quiz generado guardado en el progreso, reutilizarlo para mantener estado
        // de modo que al salir y entrar se conserven exactamente las mismas preguntas y el orden barajado
        $preguntasAleatorias = [];
        if ($progreso && !empty($progreso->quiz_generado)) {
            $preguntasAleatorias = $progreso->quiz_generado;
        } else {
            // Seleccionar 5 preguntas aleatorias del banco y barajar sus opciones
            $quizData = $leccion->quiz ?? [];
            $preguntasBanco = $quizData['banco_preguntas'] ?? ($quizData['preguntas'] ?? []);

            if (!empty($preguntasBanco)) {
                shuffle($preguntasBanco);
                $seleccionadas = array_slice($preguntasBanco, 0, 5);

                foreach ($seleccionadas as $p) {
                    $opcionesOriginales = $p['opciones'];
                    $idxCorrecta = $p['respuesta_correcta'];
                    $textoCorrecto = $opcionesOriginales[$idxCorrecta];

                    // Barajar opciones conservando cuál es la correcta
                    $opcionesBarajadas = $opcionesOriginales;
                    shuffle($opcionesBarajadas);
                    $nuevoIdxCorrecto = array_search($textoCorrecto, $opcionesBarajadas);

                    $preguntasAleatorias[] = [
                        'id' => $p['id'],
                        'pregunta' => $p['pregunta'],
                        'opciones' => $opcionesBarajadas,
                        'respuesta_correcta' => $nuevoIdxCorrecto,
                        'explicacion' => $p['explicacion'] ?? '',
                    ];
                }

                // Guardar en progreso del usuario para persistencia entre sesiones
                $progreso = ProgresoEstudiante::firstOrNew([
                    'id_usuario' => $userId,
                    'id_concepto' => $leccion->id_concepto,
                ]);
                $progreso->quiz_generado = $preguntasAleatorias;
                $progreso->save();
            }
        }

        // Siguiente lección para navegación
        $siguienteLeccion = ConceptoFinanciero::where('orden', '>', $leccion->orden)
            ->orderBy('orden', 'asc')
            ->first();

        $anteriorLeccion = ConceptoFinanciero::where('orden', '<', $leccion->orden)
            ->orderBy('orden', 'desc')
            ->first();

        // Respuestas previamente guardadas por el estudiante si las hay
        $respuestasGuardadas = $progreso->respuestas_usuario ?? [];
        $encuesta = EncuestaModulo::where('id_usuario', $userId)
            ->where('id_concepto', $leccion->id_concepto)
            ->first();

        return view('aprendizaje.show', compact('leccion', 'progreso', 'siguienteLeccion', 'anteriorLeccion', 'preguntasAleatorias', 'respuestasGuardadas', 'encuesta'));
    }

    /**
     * Guarda la opinión obligatoria del estudiante al completar un módulo.
     */
    public function guardarEncuesta(Request $request, $slug)
    {
        $userId = Auth::id();
        $leccion = ConceptoFinanciero::where('slug', $slug)->firstOrFail();
        $progreso = ProgresoEstudiante::where('id_usuario', $userId)
            ->where('id_concepto', $leccion->id_concepto)
            ->first();

        if (!$progreso?->completado) {
            return response()->json([
                'error' => 'Debes aprobar el módulo antes de contestar la encuesta.',
            ], 422);
        }

        $datos = $request->validate([
            'calificacion' => ['required', 'integer', 'between:1,5'],
            'comentario' => ['nullable', 'string', 'max:1000'],
        ]);

        EncuestaModulo::updateOrCreate(
            [
                'id_usuario' => $userId,
                'id_concepto' => $leccion->id_concepto,
            ],
            $datos
        );

        return response()->json([
            'success' => true,
            'mensaje' => 'Gracias por compartir tu opinión.',
        ]);
    }

    /**
     * Evalúa el Quiz / Ejercicio y guarda el progreso en DB.
     */
    public function evaluarQuiz(Request $request, $slug)
    {
        $userId = Auth::id();
        $leccion = ConceptoFinanciero::where('slug', $slug)->firstOrFail();

        if (!$this->leccionEstaDesbloqueada($leccion, $userId)) {
            return response()->json([
                'error' => 'Debes completar las lecciones previas para desbloquear este módulo.',
            ], 403);
        }

        $progreso = ProgresoEstudiante::firstOrNew([
            'id_usuario' => $userId,
            'id_concepto' => $leccion->id_concepto,
        ]);

        // Usar las preguntas generadas persistidas con sus opciones barajadas
        $preguntasActivas = $progreso->quiz_generado;
        if (empty($preguntasActivas)) {
            $quizData = $leccion->quiz;
            $preguntasActivas = $quizData['banco_preguntas'] ?? ($quizData['preguntas'] ?? []);
        }

        if (empty($preguntasActivas)) {
            return response()->json(['error' => 'No hay evaluación para esta lección.'], 400);
        }

        $preguntasPorId = [];
        foreach ($preguntasActivas as $p) {
            $preguntasPorId[$p['id']] = $p;
        }

        $respuestasEnviadas = $request->input('respuestas', []);
        $totalRespondidas = count($respuestasEnviadas);

        if ($totalRespondidas === 0) {
            return response()->json(['error' => 'Por favor responde las preguntas antes de evaluar.'], 422);
        }

        $aciertos = 0;
        $retroalimentacion = [];

        foreach ($respuestasEnviadas as $idPregunta => $respuestaSeleccionada) {
            if (isset($preguntasPorId[$idPregunta])) {
                $pregunta = $preguntasPorId[$idPregunta];
                $esCorrecta = ((int)$respuestaSeleccionada === (int)$pregunta['respuesta_correcta']);

                if ($esCorrecta) {
                    $aciertos++;
                }

                $retroalimentacion[] = [
                    'id' => $idPregunta,
                    'correcta' => $esCorrecta,
                    'respuesta_usuario' => $respuestaSeleccionada,
                    'explicacion' => $pregunta['explicacion'] ?? ''
                ];
            }
        }

        $puntaje = round(($aciertos / $totalRespondidas) * 100);
        $aprobado = $puntaje >= 70; // 70% o más para aprobar (ej: al menos 4 de 5)

        $progreso->intentos = ($progreso->intentos ?? 0) + 1;
        $progreso->puntaje_quiz = max($progreso->puntaje_quiz ?? 0, $puntaje);
        $progreso->respuestas_usuario = $respuestasEnviadas;

        if ($aprobado) {
            $progreso->completado = true;
            $progreso->fecha_completado = now();
        }

        $progreso->save();

        return response()->json([
            'success' => true,
            'aprobado' => $aprobado,
            'puntaje' => $puntaje,
            'aciertos' => $aciertos,
            'total' => $totalRespondidas,
            'retroalimentacion' => $retroalimentacion,
            'mensaje' => $aprobado
                ? '¡Excelente trabajo! Has dominado este concepto y desbloqueado la siguiente lección.'
                : 'Aún no alcanzas el puntaje aprobatorio (70%). Revisa las explicaciones e inténtalo de nuevo.'
        ]);
    }

    private function leccionEstaDesbloqueada(ConceptoFinanciero $leccion, int $userId): bool
    {
        $lecciones = ConceptoFinanciero::orderBy('orden', 'asc')->get();
        $progresos = ProgresoEstudiante::where('id_usuario', $userId)
            ->get()
            ->keyBy('id_concepto');

        $anteriorCompletada = true;

        foreach ($lecciones as $index => $item) {
            if ($item->id_concepto === $leccion->id_concepto) {
                return ($index === 0) || $anteriorCompletada;
            }

            $progreso = $progresos->get($item->id_concepto);
            $anteriorCompletada = (bool) ($progreso?->completado);
        }

        return false;
    }

    /**
     * Reinicia el quiz para generar nuevas preguntas y opciones aleatorias si el estudiante desea reintentar
     */
    public function reintentarQuiz($slug)
    {
        $userId = Auth::id();
        $leccion = ConceptoFinanciero::where('slug', $slug)->firstOrFail();

        $progreso = ProgresoEstudiante::where('id_usuario', $userId)
            ->where('id_concepto', $leccion->id_concepto)
            ->first();

        if ($progreso) {
            $progreso->quiz_generado = null; // Fuerza a barajar nuevas preguntas y opciones
            $progreso->save();
        }

        return redirect()->route('aprendizaje.show', $slug);
    }

    /**
     * Muestra el simulador financiero interactivo independiente (Laboratorio Sandbox)
     */
    public function simulador()
    {
        return view('aprendizaje.simulador');
    }
}
