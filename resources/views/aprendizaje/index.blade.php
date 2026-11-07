@extends('layouts.plantilla')

@section('title', 'Academia de Costos & Mermas')

@section('content')

{{-- Encabezado estándar Eat-Cost --}}
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="mb-4 sm:mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                    Academia de Costos
                    <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                </h1>
                <p class="text-gray-600 mt-2 font-medium">
                    Domina la teoría de costos, mermas, absorción, punto de equilibrio y márgenes con prácticas interactivas.
                </p>
            </div>
            
            <div class="mb-4 sm:mb-8 flex items-center gap-3">
                <a href="{{ route('aprendizaje.simulador') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl py-2.5 px-4 shadow-sm shadow-emerald-600/20 transition-all hover:-translate-y-0.5 mt-3">
                    <i class="ri-dashboard-3-line text-lg"></i>
                    <span>Simulador Financiero</span>
                </a>
            </div>
        </div>
        <hr class="mb-8 border-gray-200 border-dashed">

        {{-- Alertas si las hay --}}
        @if (session('status_error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <i class="ri-error-warning-line text-lg"></i>
                <span>{{ session('status_error') }}</span>
            </div>
        @endif

        {{-- Tarjeta de Resumen de Progreso (Alineada con el estilo del sitio) --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-2xl shrink-0">
                        <i class="ri-graduation-cap-line"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Progreso formativo del estudiante</h2>
                        <p class="text-sm text-gray-500 mt-0.5">
                            {{ $completadasCount }} de {{ $totalLecciones }} módulos completados
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                    <div class="flex items-center justify-between text-xs font-bold text-gray-700 mb-1.5">
                        <span>Avance general</span>
                        <span class="text-emerald-700">{{ $porcentajeProgreso }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden p-0.5 border border-gray-200">
                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" style="width: {{ $porcentajeProgreso }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Listado de Módulos (Estilo Eat-Cost con cards blancas y bordes tenues) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($lecciones as $index => $leccion)
                @php
                    $isLocked = !$leccion->desbloqueada;
                    $isDone = $leccion->esta_completada;
                @endphp

                <div class="bg-white rounded-2xl shadow-sm border {{ $isDone ? 'border-emerald-200 ring-1 ring-emerald-500/10' : ($isLocked ? 'border-gray-200 opacity-60' : 'border-gray-200 hover:border-emerald-400 hover:shadow-md') }} transition-all flex flex-col p-6">
                    
                    {{-- Badges Superiores --}}
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg {{ $isDone ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $leccion->badge_categoria }}
                        </span>

                        @if ($isDone)
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                <i class="ri-checkbox-circle-fill"></i> Aprobado ({{ $leccion->progreso->puntaje_quiz }}%)
                            </span>
                        @elseif ($isLocked)
                            <span class="inline-flex items-center gap-1 text-xs font-medium text-gray-400 bg-gray-50 px-2 py-0.5 rounded-full border border-gray-200">
                                <i class="ri-lock-line"></i> Bloqueado
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                <i class="ri-play-circle-line"></i> Disponible
                            </span>
                        @endif
                    </div>

                    {{-- Icono & Título --}}
                    <div class="flex items-start gap-4 mb-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 {{ $isDone ? 'bg-emerald-600 text-white' : ($isLocked ? 'bg-gray-100 text-gray-400' : 'bg-emerald-50 text-emerald-600 border border-emerald-100') }}">
                            <i class="{{ $leccion->icono ?? 'ri-book-open-line' }} text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide">Módulo {{ $leccion->orden }}</p>
                            <h3 class="text-lg font-bold text-gray-900 leading-snug">
                                {{ $leccion->titulo }}
                            </h3>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <p class="text-gray-600 text-sm mb-5 leading-relaxed flex-1">
                        {{ $leccion->descripcion }}
                    </p>

                    {{-- Caja Fórmula --}}
                    <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 mb-5">
                        <p class="text-[11px] font-bold uppercase text-gray-500 mb-1">Fórmula clave</p>
                        <p class="text-xs font-mono font-medium text-gray-800 truncate" title="{{ $leccion->formula }}">
                            {{ $leccion->formula }}
                        </p>
                    </div>

                    {{-- Botón de Acción --}}
                    <div class="mt-auto">
                        @if ($isLocked)
                            <button disabled class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gray-100 text-gray-400 font-medium text-sm cursor-not-allowed">
                                <i class="ri-lock-line"></i>
                                <span>Completa la lección anterior</span>
                            </button>
                        @else
                            <a href="{{ route('aprendizaje.show', $leccion->slug) }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl {{ $isDone ? 'bg-white text-emerald-700 border border-emerald-300 hover:bg-emerald-50' : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm shadow-emerald-600/20' }} font-medium text-sm transition-colors">
                                <span>{{ $isDone ? 'Repasar lección' : 'Iniciar lección' }}</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
