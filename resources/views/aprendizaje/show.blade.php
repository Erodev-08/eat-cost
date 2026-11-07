@extends('layouts.plantilla')

@section('title', $leccion->titulo . ' - Eat-Cost')

@section('content')

{{-- ENCABEZADO ESTÁNDAR DEL SITIO (Idéntico a calcular.blade.php y recetas) --}}
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="mb-4 sm:mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100">
                        {{ $leccion->badge_categoria }}
                    </span>
                    <span class="text-xs text-gray-400 font-medium">Módulo {{ $leccion->orden }} de 6</span>
                    @if ($progreso && $progreso->completado)
                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            <i class="ri-checkbox-circle-fill"></i> Completado ({{ $progreso->puntaje_quiz }}%)
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                    {{ $leccion->titulo }}
                    <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                </h1>
                <p class="text-gray-500 mt-2 font-medium max-w-3xl">
                    {{ $leccion->descripcion }}
                </p>
            </div>

            <div class="mb-4 sm:mb-8 flex items-center gap-3">
                @if (isset($leccion->contenido_detallado['modal_alert']))
                    <button type="button" onclick="abrirModalAlert()" class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-lightbulb-line text-lg text-emerald-600"></i>
                        <span>Consejo Clave</span>
                    </button>
                @endif
                <a href="{{ route('aprendizaje.index') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                    <i class="ri-arrow-left-line text-lg"></i>
                    <span>Volver</span>
                </a>
            </div>
        </div>
        <hr class="mb-8 border-gray-200 border-dashed">
    </div>
</div>

{{-- CONTENEDOR PRINCIPAL --}}
<div class="px-5 py-3 md:px-5 md:py-4">
    <div class="mx-auto max-w-7xl">

        {{-- CARD PRINCIPAL --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- HEADER CON PESTAÑAS --}}
            <div class="p-6 md:p-8 border-b border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100/70 border border-emerald-200 text-emerald-700 flex items-center justify-center shrink-0 text-2xl">
                            <i class="{{ $leccion->icono }}"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Módulo de Estudio</p>
                            <h2 class="text-xl font-bold text-gray-900">{{ $leccion->titulo }}</h2>
                        </div>
                    </div>

                    {{-- Pestañas limpias --}}
                    <div class="inline-flex p-1 bg-white rounded-xl border border-gray-200 shadow-2xs self-start sm:self-auto">
                        <button type="button" onclick="mostrarPestana('teoria')" id="btn-tab-teoria" class="px-4 py-2 text-xs font-bold rounded-lg transition-all flex items-center gap-2 bg-emerald-600 text-white shadow-xs">
                            <i class="ri-book-read-line"></i>
                            <span>1. Teoría & Fórmula</span>
                        </button>
                        <button type="button" onclick="mostrarPestana('practica')" id="btn-tab-practica" class="px-4 py-2 text-xs font-bold text-gray-600 hover:text-gray-900 rounded-lg transition-all flex items-center gap-2">
                            <i class="ri-flask-line"></i>
                            <span>2. Práctica</span>
                        </button>
                        <button type="button" onclick="mostrarPestana('evaluacion')" id="btn-tab-evaluacion" class="px-4 py-2 text-xs font-bold text-gray-600 hover:text-gray-900 rounded-lg transition-all flex items-center gap-2">
                            <i class="ri-questionnaire-line"></i>
                            <span>3. Quiz</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 1. PESTAÑA: TEORÍA (Breve y concisa) --}}
            <div id="tab-content-teoria" class="p-6 md:p-10 space-y-6">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    {{-- Columna Izquierda: Concepto y puntos directos --}}
                    <div class="lg:col-span-7 space-y-5">
                        <div>
                            <h3 class="text-base font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <i class="ri-file-text-line text-emerald-600"></i>
                                <span>Concepto Esencial</span>
                            </h3>
                            <p class="text-gray-700 leading-relaxed text-sm font-medium">
                                {{ $leccion->contenido_detallado['introduccion'] ?? $leccion->descripcion }}
                            </p>
                        </div>

                        {{-- Puntos Clave Breves --}}
                        @if (isset($leccion->contenido_detallado['puntos_clave']))
                            <div class="space-y-3">
                                @foreach ($leccion->contenido_detallado['puntos_clave'] as $punto)
                                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-start gap-3">
                                        <div class="w-6 h-6 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                            <i class="ri-check-line"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-900">{{ $punto['titulo'] }}</h4>
                                            <p class="text-xs sm:text-sm text-gray-600 mt-0.5 leading-relaxed">{{ $punto['texto'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Regla de Oro --}}
                        @if (isset($leccion->contenido_detallado['regla_de_oro']))
                            <div class="p-4 bg-emerald-50/60 border border-emerald-200 rounded-xl flex items-start gap-3">
                                <i class="ri-lightbulb-line text-lg text-emerald-600 shrink-0 mt-0.5"></i>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-800">Regla de Oro en Cocina</p>
                                    <p class="text-xs sm:text-sm text-gray-700 mt-1 font-medium leading-relaxed">
                                        {{ $leccion->contenido_detallado['regla_de_oro'] }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Columna Derecha: Fórmula compacta y Ejemplo --}}
                    <div class="lg:col-span-5 space-y-4">
                        
                        {{-- Caja de Fórmula --}}
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-200">
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 flex items-center gap-1.5">
                                <i class="ri-functions text-emerald-600"></i> Fórmula Clave
                            </p>
                            <div class="p-3.5 bg-white rounded-xl border border-gray-200 font-mono text-sm font-bold text-emerald-700 shadow-2xs leading-relaxed">
                                {{ $leccion->formula }}
                            </div>
                        </div>

                        {{-- Caso Culinario Real --}}
                        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-2xs">
                            <p class="text-xs font-bold uppercase tracking-wider text-emerald-700 mb-2 flex items-center gap-1.5">
                                <i class="ri-restaurant-line"></i> Ejemplo Rápido
                            </p>
                            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed font-medium">
                                {{ $leccion->ejemplo }}
                            </p>
                        </div>

                        {{-- Botón para ver Modal Alert --}}
                        @if (isset($leccion->contenido_detallado['modal_alert']))
                            <button type="button" onclick="abrirModalAlert()" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-bold transition-all">
                                <i class="ri-notification-3-line"></i>
                                <span>Ver Alerta Importante del Tema</span>
                            </button>
                        @endif

                        {{-- Botón de avance --}}
                        <button type="button" onclick="mostrarPestana('practica')" class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm shadow-emerald-600/20 transition-all">
                            <span>Pasar a la Práctica</span>
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>

                </div>

            </div>

            {{-- 2. PESTAÑA: LABORATORIO PRÁCTICO --}}
            <div id="tab-content-practica" class="p-6 md:p-10 space-y-6 hidden">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-6 text-center">
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-100">
                            Práctica Breve
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">Laboratorio Interactivo</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                            {{ $leccion->ejercicio_interactivo['instruccion'] ?? 'Interactúa con los controles para ver el comportamiento del cálculo.' }}
                        </p>
                    </div>

                    @php $tipoEjercicio = $leccion->ejercicio_interactivo['tipo'] ?? 'generico'; @endphp

                    @if ($tipoEjercicio === 'clasificador')
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                            <div class="space-y-2.5" id="lista-clasificador">
                                @foreach ($leccion->ejercicio_interactivo['items'] as $item)
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3.5 bg-gray-50 rounded-xl border border-gray-200 gap-3" data-id="{{ $item['id'] }}" data-correcta="{{ $item['tipo'] }}">
                                        <span class="text-sm font-semibold text-gray-800">{{ $item['nombre'] }}</span>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <button type="button" onclick="marcarClasificador(this, 'fijo')" class="px-3 py-1.5 text-xs font-bold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition-colors btn-fijo">
                                                Costo Fijo
                                            </button>
                                            <button type="button" onclick="marcarClasificador(this, 'variable')" class="px-3 py-1.5 text-xs font-bold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition-colors btn-variable">
                                                Costo Variable
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" onclick="verificarClasificador()" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm transition-all">
                                Comprobar Clasificación
                            </button>
                            <div id="resultado-clasificador" class="mt-4 hidden p-4 rounded-xl text-sm font-medium text-center"></div>
                        </div>

                    @elseif ($tipoEjercicio === 'calculo_guiado')
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-6">
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <h4 class="text-sm font-bold text-gray-900 mb-2">Insumo: {{ $leccion->ejercicio_interactivo['datos']['producto'] }}</h4>
                                <div class="grid grid-cols-2 gap-4 text-xs">
                                    <div><span class="text-gray-500">Peso Bruto (AP):</span> <strong class="text-gray-900">{{ $leccion->ejercicio_interactivo['datos']['peso_bruto_kg'] }} kg</strong></div>
                                    <div><span class="text-gray-500">Peso Limpio (EP):</span> <strong class="text-emerald-700">{{ $leccion->ejercicio_interactivo['datos']['peso_limpio_kg'] }} kg</strong></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">¿Cuántos kg de merma hubo?</label>
                                    <input type="number" step="0.01" id="input_merma_kg" placeholder="Ej. 1.35" class="w-full text-sm rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">¿Cuál es el % de merma?</label>
                                    <input type="number" step="0.1" id="input_merma_pct" placeholder="Ej. 30" class="w-full text-sm rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                            </div>

                            <button type="button" onclick="verificarCalculoMerma()" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm transition-all">
                                Comprobar Cálculo
                            </button>
                            <div id="resultado-merma" class="hidden p-4 rounded-xl text-sm font-medium text-center"></div>
                        </div>

                    @elseif ($tipoEjercicio === 'simulador_absorcion')
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-6">
                            <div>
                                <label class="flex items-center justify-between text-sm font-bold text-gray-800 mb-2">
                                    <span>Costo de Compra por Kilo Bruto:</span>
                                    <span class="text-emerald-700 font-extrabold text-base" id="label_costo_compra">$120.00 MXN</span>
                                </label>
                                <input type="range" min="50" max="500" step="10" value="120" id="slider_costo_compra" oninput="actualizarAbsorcion()" class="w-full accent-emerald-600">
                            </div>

                            <div>
                                <label class="flex items-center justify-between text-sm font-bold text-gray-800 mb-2">
                                    <span>Porcentaje de Merma:</span>
                                    <span class="text-red-600 font-extrabold text-base" id="label_pct_merma">30%</span>
                                </label>
                                <input type="range" min="0" max="80" step="5" value="30" id="slider_pct_merma" oninput="actualizarAbsorcion()" class="w-full accent-red-600">
                            </div>

                            <div class="p-5 bg-emerald-50 rounded-2xl border border-emerald-100 text-center">
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Costo Real por Kilo Limpio:</span>
                                <div class="text-3xl font-extrabold text-emerald-700 my-1" id="val_costo_absorbido">$171.43 MXN</div>
                                <p class="text-xs text-gray-600">
                                    El desperdicio eleva el costo en un <strong id="val_sobrecosto" class="text-red-600">+42.8%</strong> sobre la factura.
                                </p>
                            </div>
                        </div>

                    @elseif ($tipoEjercicio === 'calculadora_pe')
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Costos Fijos ($)</label>
                                    <input type="number" id="pe_cf" value="24000" oninput="calcularPE()" class="w-full text-sm rounded-xl border-gray-300">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Precio Venta ($)</label>
                                    <input type="number" id="pe_precio" value="180" oninput="calcularPE()" class="w-full text-sm rounded-xl border-gray-300">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Costo Variable ($)</label>
                                    <input type="number" id="pe_cv" value="60" oninput="calcularPE()" class="w-full text-sm rounded-xl border-gray-300">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div class="p-3 bg-gray-50 rounded-xl border border-gray-200">
                                    <p class="text-xs text-gray-500 font-bold uppercase">Margen Unitario</p>
                                    <p class="text-xl font-bold text-gray-900 mt-1" id="pe_mcu">$120.00</p>
                                </div>
                                <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                                    <p class="text-xs text-emerald-800 font-bold uppercase">Punto de Equilibrio</p>
                                    <p class="text-xl font-extrabold text-emerald-700 mt-1" id="pe_unidades">200 platos</p>
                                </div>
                            </div>
                        </div>

                    @elseif ($tipoEjercicio === 'conversor_margen')
                        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
                            <div>
                                <label class="flex items-center justify-between text-sm font-bold text-gray-800 mb-2">
                                    <span>Costo del Platillo:</span>
                                    <span class="text-emerald-700 font-extrabold" id="val_costo_p">$75.00 MXN</span>
                                </label>
                                <input type="range" min="20" max="300" step="5" value="75" id="slider_costo_p" oninput="actualizarMargenVsMarkup()" class="w-full accent-emerald-600">
                            </div>

                            <div>
                                <label class="flex items-center justify-between text-sm font-bold text-gray-800 mb-2">
                                    <span>Margen Deseado (%):</span>
                                    <span class="text-emerald-700 font-extrabold" id="val_margen_p">70%</span>
                                </label>
                                <input type="range" min="30" max="85" step="5" value="70" id="slider_margen_p" oninput="actualizarMargenVsMarkup()" class="w-full accent-emerald-600">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="p-3.5 rounded-xl border border-red-200 bg-red-50 text-center">
                                    <p class="text-xs font-bold uppercase text-red-800">Error (Markup directo)</p>
                                    <p class="text-xl font-bold text-red-700 mt-1" id="res_markup">$127.50</p>
                                    <p class="text-[11px] text-red-600 mt-0.5">Margen real: solo 41.2%</p>
                                </div>
                                <div class="p-3.5 rounded-xl border border-emerald-200 bg-emerald-50 text-center">
                                    <p class="text-xs font-bold uppercase text-emerald-800">Correcto (Margen Real)</p>
                                    <p class="text-xl font-extrabold text-emerald-700 mt-1" id="res_margen_real">$250.00</p>
                                    <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Margen real: 70.0% Exacto</p>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 text-center">
                            <i class="ri-dashboard-3-line text-3xl text-emerald-600 mb-2"></i>
                            <h4 class="text-base font-bold text-gray-900">Simulador Financiero Integral</h4>
                            <p class="text-xs text-gray-600 max-w-md mx-auto mt-1 mb-4">
                                Esta lección final se practica a través del simulador financiero en tiempo real.
                            </p>
                            <a href="{{ route('aprendizaje.simulador') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs shadow-sm">
                                <span>Abrir Simulador Financiero</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    @endif

                    <div class="text-center pt-2">
                        <button type="button" onclick="mostrarPestana('evaluacion')" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm transition-all">
                            <span>Pasar a la Evaluación</span>
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 3. PESTAÑA: EVALUACIÓN (Quiz de 5 preguntas aleatorias) --}}
            <div id="tab-content-evaluacion" class="p-6 md:p-10 space-y-6 hidden">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-6 text-center">
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-100">
                            Evaluación Rápida
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">Quiz del Módulo (5 Preguntas)</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                            Responde las 5 preguntas seleccionadas aleatoriamente sobre el tema para validar tu conocimiento (Aprobatorio: 70%).
                        </p>
                    </div>

                    <form id="form-evaluacion" onsubmit="enviarEvaluacion(event)" class="space-y-5">
                        @csrf
                        @if (isset($preguntasAleatorias) && count($preguntasAleatorias) > 0)
                            @foreach ($preguntasAleatorias as $idx => $pregunta)
                                <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 card-pregunta" id="card-pregunta-{{ $pregunta['id'] }}">
                                    <div class="flex items-start gap-3 mb-3">
                                        <div class="w-6 h-6 rounded-lg bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">
                                            {{ $idx + 1 }}
                                        </div>
                                        <h4 class="text-sm font-bold text-gray-900 leading-snug">
                                            {{ $pregunta['pregunta'] }}
                                        </h4>
                                    </div>

                                    <div class="space-y-2 pl-9">
                                        @foreach ($pregunta['opciones'] as $opcionIdx => $opcionTexto)
                                            @php
                                                $estaSeleccionada = isset($respuestasGuardadas[$pregunta['id']]) && ((int)$respuestasGuardadas[$pregunta['id']] === (int)$opcionIdx);
                                            @endphp
                                            <label class="flex items-center gap-3 p-2.5 rounded-xl bg-white border border-gray-200 hover:border-emerald-400 cursor-pointer transition-all {{ $estaSeleccionada ? 'border-emerald-500 bg-emerald-50/30' : '' }}">
                                                <input type="radio" name="respuestas[{{ $pregunta['id'] }}]" value="{{ $opcionIdx }}" {{ $estaSeleccionada ? 'checked' : '' }} required class="text-emerald-600 focus:ring-emerald-500">
                                                <span class="text-xs sm:text-sm text-gray-700 font-medium">{{ $opcionTexto }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                    <div class="retro-box mt-3 hidden p-3 rounded-xl text-xs font-medium"></div>
                                </div>
                            @endforeach
                        @endif

                        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                            <button type="submit" id="btn-evaluar" class="w-full sm:flex-1 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm transition-all flex items-center justify-center gap-2">
                                <i class="ri-check-line text-lg"></i>
                                <span>Evaluar y Guardar Progreso</span>
                            </button>
                        </div>
                    </form>

                    {{-- Botón para generar nuevas preguntas aleatorias si desea reintentar --}}
                    <div class="pt-2 text-center">
                        <form action="{{ route('aprendizaje.reintentar', $leccion->slug) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-emerald-700 transition-colors py-1 px-3 rounded-lg hover:bg-gray-100">
                                <i class="ri-shuffle-line"></i>
                                <span>Generar nuevo test con otras preguntas aleatorias</span>
                            </button>
                        </form>
                    </div>

                    {{-- Resultado general --}}
                    <div id="resultado-evaluacion" class="mt-6 hidden p-5 rounded-2xl border text-center"></div>

                    {{-- Botón a siguiente módulo --}}
                    @if ($siguienteLeccion)
                        <div id="btn-siguiente-modulo" class="mt-4 hidden text-center">
                            <a href="{{ route('aprendizaje.show', $siguienteLeccion->slug) }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm shadow-sm transition-all">
                                <span>Avanzar a: {{ $siguienteLeccion->titulo }}</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>

{{-- MODAL ALERT (POPUP ESTILO EAT-COST) --}}
@if (isset($leccion->contenido_detallado['modal_alert']))
<div id="modal-alert-backdrop" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 transform transition-transform duration-200 scale-95" id="modal-alert-panel">
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                    <i class="ri-lightbulb-flash-line"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 leading-tight">
                    {{ $leccion->contenido_detallado['modal_alert']['titulo'] ?? 'Alerta de Aprendizaje' }}
                </h3>
            </div>
            <button type="button" onclick="cerrarModalAlert()" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>

        <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-100 text-emerald-950 text-sm leading-relaxed mb-6 font-medium">
            {{ $leccion->contenido_detallado['modal_alert']['mensaje'] }}
        </div>

        <div class="flex justify-end gap-3">
            <button type="button" onclick="cerrarModalAlert()" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-sm">
                Entendido
            </button>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    function mostrarPestana(pestana) {
        ['teoria', 'practica', 'evaluacion'].forEach(p => {
            document.getElementById('tab-content-' + p).classList.add('hidden');
            let btn = document.getElementById('btn-tab-' + p);
            btn.className = 'px-4 py-2 text-xs font-bold text-gray-600 hover:text-gray-900 rounded-lg transition-all flex items-center gap-2';
        });

        document.getElementById('tab-content-' + pestana).classList.remove('hidden');
        let activeBtn = document.getElementById('btn-tab-' + pestana);
        activeBtn.className = 'px-4 py-2 text-xs font-bold rounded-lg transition-all flex items-center gap-2 bg-emerald-600 text-white shadow-xs';
    }

    // Funciones del Modal Alert
    function abrirModalAlert() {
        let modal = document.getElementById('modal-alert-backdrop');
        let panel = document.getElementById('modal-alert-panel');
        if (modal && panel) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('scale-95');
                panel.classList.add('scale-100');
            }, 10);
        }
    }

    function cerrarModalAlert() {
        let modal = document.getElementById('modal-alert-backdrop');
        let panel = document.getElementById('modal-alert-panel');
        if (modal && panel) {
            panel.classList.remove('scale-100');
            panel.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }
    }

    // Cerrar con Escape o clic fuera
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') cerrarModalAlert();
    });
    document.addEventListener('click', (e) => {
        let modal = document.getElementById('modal-alert-backdrop');
        if (modal && e.target === modal) cerrarModalAlert();
    });

    // Clasificador
    let selecciones = {};
    function marcarClasificador(btn, tipo) {
        let parent = btn.closest('[data-id]');
        let id = parent.dataset.id;
        selecciones[id] = tipo;

        parent.querySelectorAll('button').forEach(b => {
            b.className = 'px-3 py-1.5 text-xs font-bold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition-colors';
        });

        btn.className = 'px-3 py-1.5 text-xs font-bold rounded-lg bg-emerald-600 text-white border border-emerald-600 transition-colors';
    }

    function verificarClasificador() {
        let items = document.querySelectorAll('#lista-clasificador [data-id]');
        let correctos = 0;
        items.forEach(item => {
            let id = item.dataset.id;
            let correcta = item.dataset.correcta;
            if (selecciones[id] === correcta) {
                correctos++;
                item.className = 'flex flex-col sm:flex-row sm:items-center justify-between p-3.5 bg-emerald-50 rounded-xl border border-emerald-300 gap-3';
            } else {
                item.className = 'flex flex-col sm:flex-row sm:items-center justify-between p-3.5 bg-red-50 rounded-xl border border-red-300 gap-3';
            }
        });

        let res = document.getElementById('resultado-clasificador');
        res.classList.remove('hidden');
        if (correctos === items.length) {
            res.className = 'mt-4 p-4 rounded-xl text-sm font-bold text-center bg-emerald-100 border border-emerald-200 text-emerald-800';
            res.innerHTML = '¡Excelente! Clasificaste todos los conceptos correctamente.';
        } else {
            res.className = 'mt-4 p-4 rounded-xl text-sm font-bold text-center bg-amber-50 border border-amber-200 text-amber-800';
            res.innerHTML = `Acertaste ${correctos} de ${items.length}. Revisa los que están en rojo y vuelve a intentar.`;
        }
    }

    // Cálculo guiado merma
    function verificarCalculoMerma() {
        let mermaKg = parseFloat(document.getElementById('input_merma_kg').value);
        let mermaPct = parseFloat(document.getElementById('input_merma_pct').value);
        let res = document.getElementById('resultado-merma');
        res.classList.remove('hidden');

        let okKg = Math.abs(mermaKg - 1.35) < 0.05;
        let okPct = Math.abs(mermaPct - 30.0) < 0.5;

        if (okKg && okPct) {
            res.className = 'p-4 rounded-xl text-sm font-bold text-center bg-emerald-100 border border-emerald-200 text-emerald-800';
            res.innerHTML = '¡Cálculo Correcto! 4.5 kg - 3.15 kg = 1.35 kg de merma (30.0%).';
        } else {
            res.className = 'p-4 rounded-xl text-sm font-bold text-center bg-red-50 border border-red-200 text-red-800';
            res.innerHTML = 'Revisa tus cálculos: Merma (kg) = Peso Bruto - Peso Limpio. Merma (%) = (Merma kg / Peso Bruto) * 100.';
        }
    }

    // Costo Absorbido
    function actualizarAbsorcion() {
        let costo = parseFloat(document.getElementById('slider_costo_compra').value);
        let merma = parseFloat(document.getElementById('slider_pct_merma').value);

        document.getElementById('label_costo_compra').innerText = '$' + costo.toFixed(2) + ' MXN';
        document.getElementById('label_pct_merma').innerText = merma + '%';

        let rendimiento = (100 - merma) / 100;
        let costoAbsorbido = rendimiento > 0 ? costo / rendimiento : 0;
        let sobrecosto = rendimiento > 0 ? ((costoAbsorbido - costo) / costo) * 100 : 0;

        document.getElementById('val_costo_absorbido').innerText = '$' + costoAbsorbido.toFixed(2) + ' MXN';
        document.getElementById('val_sobrecosto').innerText = '+' + sobrecosto.toFixed(1) + '%';
    }

    // Punto de Equilibrio
    function calcularPE() {
        let cf = parseFloat(document.getElementById('pe_cf').value) || 0;
        let precio = parseFloat(document.getElementById('pe_precio').value) || 0;
        let cv = parseFloat(document.getElementById('pe_cv').value) || 0;

        let mcu = precio - cv;
        let unidades = mcu > 0 ? Math.ceil(cf / mcu) : 0;

        document.getElementById('pe_mcu').innerText = '$' + mcu.toFixed(2);
        document.getElementById('pe_unidades').innerText = unidades + ' platos';
    }

    // Margen vs Markup
    function actualizarMargenVsMarkup() {
        let costo = parseFloat(document.getElementById('slider_costo_p').value);
        let margen = parseFloat(document.getElementById('slider_margen_p').value);

        document.getElementById('val_costo_p').innerText = '$' + costo.toFixed(2) + ' MXN';
        document.getElementById('val_margen_p').innerText = margen + '%';

        let precioMarkup = costo * (1 + (margen / 100));
        let precioMargenReal = costo / (1 - (margen / 100));

        document.getElementById('res_markup').innerText = '$' + precioMarkup.toFixed(2);
        document.getElementById('res_margen_real').innerText = '$' + precioMargenReal.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('slider_costo_compra')) actualizarAbsorcion();
        if (document.getElementById('pe_cf')) calcularPE();
        if (document.getElementById('slider_costo_p')) actualizarMargenVsMarkup();
    });

    // Envío de Evaluación
    async function enviarEvaluacion(e) {
        e.preventDefault();
        let form = document.getElementById('form-evaluacion');
        let formData = new FormData(form);
        let btn = document.getElementById('btn-evaluar');
        btn.disabled = true;
        btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Evaluando...';

        try {
            let res = await fetch("{{ route('aprendizaje.evaluar', $leccion->slug) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });

            btn.disabled = false;
            btn.innerHTML = '<i class="ri-refresh-line"></i> Reevaluar Respuestas';

            if (!res.ok) {
                let errData = await res.json().catch(() => null);
                let errMsg = (errData && errData.error) ? errData.error : (errData && errData.message ? errData.message : 'Error en el servidor al evaluar.');
                alert(errMsg);
                return;
            }

            let data = await res.json();

            if (data.retroalimentacion) {
                data.retroalimentacion.forEach(item => {
                    let card = document.getElementById('card-pregunta-' + item.id);
                    if (card) {
                        let retro = card.querySelector('.retro-box');
                        retro.classList.remove('hidden');
                        if (item.correcta) {
                            retro.className = 'retro-box mt-3 p-3 rounded-xl text-xs font-medium bg-emerald-50 text-emerald-800 border border-emerald-200';
                            retro.innerHTML = `<strong>Correcto:</strong> ${item.explicacion}`;
                        } else {
                            retro.className = 'retro-box mt-3 p-3 rounded-xl text-xs font-medium bg-red-50 text-red-800 border border-red-200';
                            retro.innerHTML = `<strong>Incorrecto:</strong> ${item.explicacion}`;
                        }
                    }
                });
            }

            let resDiv = document.getElementById('resultado-evaluacion');
            resDiv.classList.remove('hidden');
            if (data.aprobado) {
                resDiv.className = 'mt-6 p-5 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-900 text-center';
                resDiv.innerHTML = `
                    <h4 class="text-lg font-bold">¡Aprobado! Calificación: ${data.puntaje}%</h4>
                    <p class="text-xs sm:text-sm mt-1 text-emerald-700">${data.mensaje}</p>
                `;
                let btnSig = document.getElementById('btn-siguiente-modulo');
                if (btnSig) btnSig.classList.remove('hidden');

                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Módulo Aprobado',
                        text: `Obtuviste ${data.puntaje}%. Desbloqueaste el siguiente nivel.`,
                        confirmButtonColor: '#059669'
                    });
                }
            } else {
                resDiv.className = 'mt-6 p-5 rounded-2xl border border-amber-200 bg-amber-50 text-amber-900 text-center';
                resDiv.innerHTML = `
                    <h4 class="text-lg font-bold">Calificación: ${data.puntaje}%</h4>
                    <p class="text-xs sm:text-sm mt-1 text-amber-700">${data.mensaje}</p>
                `;
            }

        } catch (error) {
            console.error(error);
            btn.disabled = false;
            btn.innerText = 'Reintentar evaluación';
            alert('Ocurrió un error al enviar el quiz.');
        }
    }
</script>
@endpush
@endsection
