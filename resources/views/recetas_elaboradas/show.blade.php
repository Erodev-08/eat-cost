@extends('layouts.plantilla')

@section('title', 'Reporte de cálculo')

@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- ENCABEZADO --}}
        <div
            class="rounded-2xl shadow-xl overflow-hidden"
            style="background: linear-gradient(to right, #1d4ed8, #2563eb, #0891b2);"
        >

    <div class="grid md:grid-cols-3">

        {{-- Imagen --}}
        <div class="h-72">

            @if($recetaElaborada->receta->imagen)

                <img
                    src="{{ asset('storage/'.$recetaElaborada->receta->imagen) }}"
                    class="w-full h-full object-cover">

            @else

                <div class="h-full flex items-center justify-center bg-gray-200">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-24 h-24 text-gray-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M3 7l9-4 9 4v10l-9 4-9-4z"/>

                    </svg>

                </div>

            @endif

        </div>

        {{-- Información --}}
        <div class="md:col-span-2 text-white p-8 flex flex-col justify-center">

            <h1 class="text-4xl font-bold">

                {{ $recetaElaborada->receta->nombre_receta }}

            </h1>

            <p class="mt-2 text-blue-100">

                {{ $recetaElaborada->receta->descripcion }}

            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-8">

                <div>

                    <p class="text-blue-200">

                        Producción

                    </p>

                    <h2 class="text-2xl font-bold">

                        {{ $recetaElaborada->cantidad_porciones }}

                    </h2>

                    <small>

                        {{ ucfirst($recetaElaborada->receta->tipo_porcion) }}

                    </small>

                </div>

                <div>

                    <p class="text-blue-200">

                        Fecha

                    </p>

                    <h2 class="font-semibold">

                        {{ $recetaElaborada->created_at->format('d/m/Y') }}

                    </h2>

                </div>

                <div>

                    <p class="text-blue-200">

                        Estado

                    </p>

                    @php

                        if($recetaElaborada->utilidad_real_porcentaje >=35){

                            $color='bg-green-500';
                            $texto='Excelente';

                        }elseif($recetaElaborada->utilidad_real_porcentaje>=20){

                            $color='bg-yellow-500';
                            $texto='Aceptable';

                        }else{

                            $color='bg-red-500';
                            $texto='Riesgo';

                        }

                    @endphp

                    <span class="{{ $color }} px-4 py-2 rounded-full font-semibold">

                        {{ $texto }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Seccion 2--}}

{{-- ========================================================= --}}
{{-- SECCIÓN 2 - INDICADORES PRINCIPALES --}}
{{-- ========================================================= --}}

<div class="mt-8">

    <div class="flex items-center justify-between mb-5">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Resumen financiero
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Principales indicadores de la producción
            </p>
        </div>

    </div>


    {{-- GRID DE INDICADORES --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


        {{-- ================================================= --}}
        {{-- COSTO TOTAL --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Costo total
                    </p>

                    <h3 class="text-3xl font-bold text-gray-800 mt-2">

                        ${{ number_format(
                            $recetaElaborada->costo_total,
                            2
                        ) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Costo de toda la producción
                    </p>

                </div>


                {{-- ICONO --}}

                <div class="w-12 h-12 rounded-xl bg-red-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-red-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                            3 .895 3 2-1.343 2-3 2m0-8c1.11 0
                            2.08.402 2.599 1M12 8V6m0 12v-2m0
                            0c-1.11 0-2.08-.402-2.599-1M12 18
                            c1.11 0 2.08-.402 2.599-1" />

                    </svg>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- COSTO POR PORCIÓN --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Costo por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                    <h3 class="text-3xl font-bold text-blue-700 mt-2">

                        ${{ number_format(
                            $recetaElaborada->costo_por_porcion,
                            2
                        ) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Costo unitario de producción
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-blue-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-blue-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2
                            3 2 3 .895 3 2-1.343 2-3 2m0-8
                            V6m0 12v-2m0 0c-1.11 0-2.08-.402
                            -2.599-1M12 18c1.11 0 2.08-.402
                            2.599-1" />

                    </svg>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- PRECIO POR PORCIÓN --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Precio de venta
                    </p>

                    <h3 class="text-3xl font-bold text-green-600 mt-2">

                        ${{ number_format(
                            $recetaElaborada->precio_por_porcion,
                            2
                        ) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Precio por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-green-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-green-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2
                            3 2 3 .895 3 2-1.343 2-3 2m0-8
                            V6m0 12v-2m0 0c-1.11 0-2.08-.402
                            -2.599-1M12 18c1.11 0 2.08-.402
                            2.599-1" />

                    </svg>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- GANANCIA POR PORCIÓN --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Ganancia por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                    <h3 class="text-3xl font-bold text-emerald-600 mt-2">

                        ${{ number_format(
                            $recetaElaborada->ganancia_por_porcion,
                            2
                        ) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Utilidad obtenida por unidad
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-emerald-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-emerald-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 7h8m0 0v8m0-8-8 8
                            M3 17l6-6 4 4" />

                    </svg>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- GANANCIA TOTAL --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Ganancia total
                    </p>

                    <h3 class="text-3xl font-bold text-purple-600 mt-2">

                        ${{ number_format(
                            $recetaElaborada->ganancia_total,
                            2
                        ) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Ganancia de toda la producción
                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl bg-purple-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-purple-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 2v20m8-16H8.5a3.5 3.5 0
                            0 0 0 7h7a3.5 3.5 0 0 1 0 7H4" />

                    </svg>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- UTILIDAD REAL --}}
        {{-- ================================================= --}}

        @php

            $utilidad = (float) $recetaElaborada->utilidad_real_porcentaje;

            if ($utilidad >= 35) {

                $utilidadColor = 'text-green-600';
                $utilidadBg = 'bg-green-100';

            } elseif ($utilidad >= 20) {

                $utilidadColor = 'text-yellow-600';
                $utilidadBg = 'bg-yellow-100';

            } else {

                $utilidadColor = 'text-red-600';
                $utilidadBg = 'bg-red-100';

            }

        @endphp


        <div class="bg-white rounded-2xl shadow-md border border-gray-100
                    p-6 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Utilidad real
                    </p>

                    <h3 class="text-3xl font-bold {{ $utilidadColor }} mt-2">

                        {{ number_format($utilidad, 2) }}%

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">

                        Margen de utilidad obtenido

                    </p>

                </div>


                <div class="w-12 h-12 rounded-xl {{ $utilidadBg }}
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 {{ $utilidadColor }}"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 19V6l12-3v13M9 19
                            c0 1.657-1.79 3-4 3s-4-1.343-4-3
                            1.79-3 4-3 4 1.343 4 3z" />

                    </svg>

                </div>

            </div>


            {{-- Indicador visual de utilidad --}}

            @php
                $anchoBarra = min(max($utilidad, 0), 100);

                if ($utilidad >= 35) {
                    $colorBarra = '#22c55e';
                } elseif ($utilidad >= 20) {
                    $colorBarra = '#eab308';
                } else {
                    $colorBarra = '#ef4444';
                }
            @endphp

            <div class="mt-4">

                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">

                    <div
                        class="h-2 rounded-full transition-all duration-700"
                        style="width: {{ $anchoBarra }}%; background-color: {{ $colorBarra }};">
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{--Sección 3--}}

{{-- ========================================================= --}}
{{-- SECCIÓN 3 - DISTRIBUCIÓN DE COSTOS --}}
{{-- ========================================================= --}}

<div class="mt-8">

    {{-- TÍTULO --}}
    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Distribución de costos
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Analiza qué porcentaje del costo total representa cada categoría.
        </p>

    </div>


    {{-- CONTENEDOR PRINCIPAL --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- ================================================= --}}
        {{-- GRÁFICA DE DONA --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">

            <div class="flex items-center justify-between mb-4">

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Composición del costo
                    </h3>

                    <p class="text-sm text-gray-500">
                        Distribución porcentual
                    </p>

                </div>

                <div class="bg-blue-100 text-blue-600
                            px-3 py-1 rounded-full text-xs font-semibold">

                    100%

                </div>

            </div>


            {{-- CONTENEDOR DE LA GRÁFICA --}}

            <div class="relative h-80 flex items-center justify-center">

                <canvas id="distribucionCostosChart"></canvas>

            </div>


            {{-- TOTAL --}}

            <div class="mt-4 pt-4 border-t border-gray-100 text-center">

                <p class="text-sm text-gray-500">
                    Costo total de producción
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-1">

                    ${{ number_format(
                        $recetaElaborada->costo_total,
                        2
                    ) }}

                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- PORCENTAJES --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-800">
                    Detalle de costos
                </h3>

                <p class="text-sm text-gray-500">
                    Participación de cada categoría
                </p>

            </div>


            <div class="space-y-6">


                {{-- ========================================= --}}
                {{-- INGREDIENTES --}}
                {{-- ========================================= --}}

                <div>

                    <div class="flex justify-between items-center mb-2">

                        <div class="flex items-center gap-3">

                            <span class="w-3 h-3 rounded-full bg-blue-500"></span>

                            <span class="font-medium text-gray-700">
                                Ingredientes
                            </span>

                        </div>

                        <div class="text-right">

                            <span class="font-bold text-gray-800">
                                {{ number_format(
                                    $porcentajes['ingredientes'],
                                    2
                                ) }}%
                            </span>

                        </div>

                    </div>


                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="h-3 rounded-full transition-all duration-700"
                            style="{{ 
                                'width: ' . min(max($porcentajes['ingredientes'], 0), 100) . '%; 
                                background-color: #3b82f6;'}}">
                        </div>

                    </div>


                    <div class="flex justify-between mt-1">

                        <span class="text-xs text-gray-400">
                            Costo de ingredientes
                        </span>

                        <span class="text-xs font-semibold text-gray-600">

                            ${{ number_format(
                                $recetaElaborada->costo_neto,
                                2
                            ) }}

                        </span>

                    </div>

                </div>



                {{-- ========================================= --}}
                {{-- MANO DE OBRA --}}
                {{-- ========================================= --}}

                <div>

                    <div class="flex justify-between items-center mb-2">

                        <div class="flex items-center gap-3">

                            <span class="w-3 h-3 rounded-full bg-green-500"></span>

                            <span class="font-medium text-gray-700">
                                Mano de obra
                            </span>

                        </div>

                        <span class="font-bold text-gray-800">

                            {{ number_format(
                                $porcentajes['mano_obra'],
                                2
                            ) }}%

                        </span>

                    </div>


                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="h-3 rounded-full transition-all duration-700"
                            style="{{
                                'width: ' . min(max($porcentajes['mano_obra'], 0), 100) . '%;
                                background-color: #22c55e;'
                            }}">
                        </div>

                    </div>


                    <div class="flex justify-between mt-1">

                        <span class="text-xs text-gray-400">
                            Trabajo necesario
                        </span>

                        <span class="text-xs font-semibold text-gray-600">

                            ${{ number_format(
                                $recetaElaborada->mano_obra,
                                2
                            ) }}

                        </span>

                    </div>

                </div>



                {{-- ========================================= --}}
                {{-- COSTOS INDIRECTOS --}}
                {{-- ========================================= --}}

                <div>

                    <div class="flex justify-between items-center mb-2">

                        <div class="flex items-center gap-3">

                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>

                            <span class="font-medium text-gray-700">
                                Costos indirectos
                            </span>

                        </div>

                        <span class="font-bold text-gray-800">

                            {{ number_format(
                                $porcentajes['indirectos'],
                                2
                            ) }}%

                        </span>

                    </div>


                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="h-3 rounded-full transition-all duration-700"
                            style="{{
                                'width: ' . min(max($porcentajes['indirectos'], 0), 100) . '%;
                                background-color: #eab308;'
                            }}">
                        </div>

                    </div>


                    <div class="flex justify-between mt-1">

                        <span class="text-xs text-gray-400">
                            Costos indirectos
                        </span>

                        <span class="text-xs font-semibold text-gray-600">

                            ${{ number_format(
                                $recetaElaborada->costos_indirectos,
                                2
                            ) }}

                        </span>

                    </div>

                </div>



                {{-- ========================================= --}}
                {{-- GASTOS DE OPERACIÓN --}}
                {{-- ========================================= --}}

                <div>

                    <div class="flex justify-between items-center mb-2">

                        <div class="flex items-center gap-3">

                            <span class="w-3 h-3 rounded-full bg-red-500"></span>

                            <span class="font-medium text-gray-700">
                                Gastos de operación
                            </span>

                        </div>

                        <span class="font-bold text-gray-800">

                            {{ number_format(
                                $porcentajes['operacion'],
                                2
                            ) }}%

                        </span>

                    </div>


                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="h-3 rounded-full transition-all duration-700"
                            style="{{
                                'width: ' . min(max($porcentajes['operacion'], 0), 100) . '%;
                                background-color: #ef4444;'
                            }}">
                        </div>

                    </div>


                    <div class="flex justify-between mt-1">

                        <span class="text-xs text-gray-400">
                            Gastos de operación
                        </span>

                        <span class="text-xs font-semibold text-gray-600">

                            ${{ number_format(
                                $recetaElaborada->gastos_operacion,
                                2
                            ) }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- TOTAL --}}
            {{-- ========================================= --}}

            <div class="mt-7 pt-5 border-t border-gray-200">

                <div class="flex justify-between items-center">

                    <span class="font-semibold text-gray-600">
                        Total
                    </span>

                    <span class="text-xl font-bold text-gray-900">

                        ${{ number_format(
                            $recetaElaborada->costo_total,
                            2
                        ) }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- SECCIÓN 4 - RESUMEN DETALLADO DEL CÁLCULO --}}
{{-- ========================================================= --}}

<div class="mt-8">

    {{-- TÍTULO --}}
    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Resumen del cálculo
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Desglose de los costos y resultados de la producción.
        </p>

    </div>


    {{-- CONTENEDOR --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- ================================================= --}}
        {{-- DESGLOSE DE COSTOS --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-blue-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-blue-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 14l6-6m-5.5-4h5
                            A2.5 2.5 0 0117 6.5v11
                            a2.5 2.5 0 01-2.5 2.5h-5
                            A2.5 2.5 0 016 17.5v-11
                            A2.5 2.5 0 018.5 4z" />

                    </svg>

                </div>

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Desglose de costos
                    </h3>

                    <p class="text-sm text-gray-500">
                        Costos utilizados para producir la receta
                    </p>

                </div>

            </div>


            {{-- INGREDIENTES --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Ingredientes
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Costo neto de ingredientes
                    </p>

                </div>

                <span class="font-semibold text-gray-800">

                    ${{ number_format(
                        $recetaElaborada->costo_neto,
                        2
                    ) }}

                </span>

            </div>


            {{-- MANO DE OBRA --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Mano de obra
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Trabajo utilizado en la producción
                    </p>

                </div>

                <span class="font-semibold text-gray-800">

                    ${{ number_format(
                        $recetaElaborada->mano_obra,
                        2
                    ) }}

                </span>

            </div>


            {{-- COSTOS INDIRECTOS --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Costos indirectos
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Costos adicionales de producción
                    </p>

                </div>

                <span class="font-semibold text-gray-800">

                    ${{ number_format(
                        $recetaElaborada->costos_indirectos,
                        2
                    ) }}

                </span>

            </div>


            {{-- COSTO DE PRODUCCIÓN --}}

            <div class="flex items-center justify-between
                        py-4 border-b-2 border-gray-200">

                <div>

                    <p class="font-semibold text-gray-800">
                        Costo de producción
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Ingredientes + mano de obra + indirectos
                    </p>

                </div>

                <span class="font-bold text-blue-700">

                    ${{ number_format(
                        $recetaElaborada->costo_produccion,
                        2
                    ) }}

                </span>

            </div>


            {{-- GASTOS DE OPERACIÓN --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Gastos de operación
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Gastos relacionados con la operación
                    </p>

                </div>

                <span class="font-semibold text-gray-800">

                    ${{ number_format(
                        $recetaElaborada->gastos_operacion,
                        2
                    ) }}

                </span>

            </div>


            {{-- COSTO TOTAL --}}

            <div class="mt-5 bg-gray-50 rounded-xl p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Costo total
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Costo de toda la producción
                        </p>

                    </div>

                    <p class="text-2xl font-bold text-gray-900">

                        ${{ number_format(
                            $recetaElaborada->costo_total,
                            2
                        ) }}

                    </p>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- PRODUCCIÓN Y VENTA --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">

            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl bg-green-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-green-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3v18h18
                            M7 16l4-5 3 3 5-7" />

                    </svg>

                </div>

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Producción y venta
                    </h3>

                    <p class="text-sm text-gray-500">
                        Resultado económico de la receta
                    </p>

                </div>

            </div>


            {{-- CANTIDAD DE PORCIONES --}}

            <div class="bg-blue-50 rounded-xl p-5 mb-4">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-sm text-blue-600 font-medium">
                            Producción total
                        </p>

                        <p class="text-xs text-blue-400 mt-1">
                            Cantidad de {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                        </p>

                    </div>

                    <p class="text-3xl font-bold text-blue-700">

                        {{ $recetaElaborada->cantidad_porciones }}

                    </p>

                </div>

            </div>


            {{-- PRECIO DE VENTA --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Precio por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Precio de venta al cliente
                    </p>

                </div>

                <span class="font-semibold text-green-600">

                    ${{ number_format(
                        $recetaElaborada->precio_por_porcion,
                        2
                    ) }}

                </span>

            </div>


            {{-- PRECIO SIN IVA --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Precio sin IVA
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Precio de venta antes de impuestos
                    </p>

                </div>

                <span class="font-semibold text-gray-800">

                    ${{ number_format(
                        $recetaElaborada->precio_sin_iva,
                        2
                    ) }}

                </span>

            </div>


            {{-- COSTO POR PORCIÓN --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Costo por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Costo total dividido entre la producción
                    </p>

                </div>

                <span class="font-semibold text-red-500">

                    ${{ number_format(
                        $recetaElaborada->costo_por_porcion,
                        2
                    ) }}

                </span>

            </div>


            {{-- GANANCIA POR PORCIÓN --}}

            <div class="flex items-center justify-between
                        py-4 border-b border-gray-100">

                <div>

                    <p class="font-medium text-gray-700">
                        Ganancia por {{ strtolower($recetaElaborada->receta->tipo_porcion) }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Precio sin IVA - costo por porción
                    </p>

                </div>

                <span class="font-semibold text-emerald-600">

                    ${{ number_format(
                        $recetaElaborada->ganancia_por_porcion,
                        2
                    ) }}

                </span>

            </div>


            {{-- GANANCIA TOTAL --}}

            <div class="mt-5 bg-emerald-50 rounded-xl p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-emerald-600 font-medium">
                            Ganancia total
                        </p>

                        <p class="text-xs text-emerald-500 mt-1">
                            Ganancia obtenida por toda la producción
                        </p>

                    </div>

                    <p class="text-2xl font-bold text-emerald-700">

                        ${{ number_format(
                            $recetaElaborada->ganancia_total,
                            2
                        ) }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- SECCIÓN 5 - DETALLE TÉCNICO DE INGREDIENTES --}}
{{-- ========================================================= --}}

<div class="mt-8">

    {{-- TÍTULO --}}
    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Detalle de ingredientes
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Análisis de cantidades, rendimiento y costo de cada ingrediente.
        </p>

    </div>


    {{-- CONTENEDOR --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">


        {{-- ENCABEZADO --}}
        <div class="p-6 border-b border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Costeo de ingredientes
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $recetaElaborada->ingredientes->count() }}
                        ingredientes utilizados en esta receta.
                    </p>

                </div>


                {{-- COSTO NETO DESTACADO --}}

                <div class="bg-blue-50 border border-blue-100
                            rounded-xl px-5 py-3">

                    <p class="text-xs text-blue-500 font-medium">
                        Costo neto de ingredientes
                    </p>

                    <p class="text-xl font-bold text-blue-700">

                        ${{ number_format(
                            $recetaElaborada->costo_neto,
                            2
                        ) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TABLA --}}
        {{-- ================================================= --}}

        <div class="overflow-x-auto">

            <table class="min-w-full">

                {{-- CABECERA --}}

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-5 py-4 text-left text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Ingrediente

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Cantidad usada

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Presentación

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Peso útil

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Merma

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Rendimiento

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Costo real

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Costo unitario

                        </th>


                        <th class="px-5 py-4 text-right text-xs
                                   font-semibold text-gray-500 uppercase
                                   tracking-wider">

                            Costo receta

                        </th>

                    </tr>

                </thead>


                {{-- CUERPO --}}

                <tbody class="divide-y divide-gray-100">

                    @foreach($recetaElaborada->ingredientes as $detalle)

                        @php

                            $ingrediente = $detalle->ingrediente;

                        @endphp


                        <tr class="hover:bg-gray-50 transition-colors">


                            {{-- ================================= --}}
                            {{-- NOMBRE --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5">

                                <div class="flex items-center gap-3">

                                    {{-- ICONO --}}

                                    <div class="w-10 h-10 rounded-lg
                                                bg-blue-100
                                                flex items-center justify-center
                                                flex-shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-blue-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 7h16M4 7l2 12h12l2-12M8 7
                                                V5a4 4 0 018 0v2" />

                                        </svg>

                                    </div>


                                    <div>

                                        <p class="font-semibold text-gray-800">

                                            {{ $ingrediente->nombre }}

                                        </p>

                                        <p class="text-xs text-gray-400">

                                            {{ $detalle->unidad_usada }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- ================================= --}}
                            {{-- CANTIDAD USADA --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-medium text-gray-700">

                                    {{ number_format(
                                        $detalle->cantidad_usada,
                                        2
                                    ) }}

                                </span>

                                <span class="text-xs text-gray-400 ml-1">

                                    {{ $detalle->unidad_usada }}

                                </span>

                            </td>


                            {{-- ================================= --}}
                            {{-- PRESENTACIÓN --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-medium text-gray-700">

                                    {{ number_format(
                                        $detalle->peso_bruto,
                                        2
                                    ) }}

                                </span>

                                <span class="text-xs text-gray-400 ml-1">

                                    {{ $ingrediente->presentacion_unidad }}

                                </span>

                            </td>


                            {{-- ================================= --}}
                            {{-- PESO ÚTIL --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-medium text-gray-700">

                                    {{ number_format(
                                        $detalle->peso_util,
                                        2
                                    ) }}

                                </span>

                                <span class="text-xs text-gray-400 ml-1">

                                    {{ $ingrediente->presentacion_unidad }}

                                </span>

                            </td>


                            {{-- ================================= --}}
                            {{-- MERMA --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="inline-flex items-center
                                             px-2.5 py-1 rounded-full
                                             bg-red-50 text-red-600
                                             text-xs font-semibold">

                                    {{ number_format(
                                        $detalle->merma_porcentaje,
                                        2
                                    ) }}%

                                </span>

                            </td>


                            {{-- ================================= --}}
                            {{-- RENDIMIENTO --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                @php

                                    $rendimiento =
                                        ((float) $detalle->rendimiento) * 100;

                                @endphp


                                <div class="flex flex-col items-end gap-1">

                                    <span class="font-semibold text-gray-700">

                                        {{ number_format(
                                            $rendimiento,
                                            2
                                        ) }}%

                                    </span>


                                    <div class="w-20 bg-gray-200
                                                rounded-full h-1.5">

                                        <div
                                            class="bg-green-500 h-1.5
                                                   rounded-full"
                                            style="width:
                                                {{ min(max($rendimiento, 0), 100) }}%">
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- ================================= --}}
                            {{-- COSTO REAL --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-medium text-gray-700">

                                    ${{ number_format(
                                        $detalle->costo_real,
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- ================================= --}}
                            {{-- COSTO UNITARIO --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-medium text-gray-700">

                                    ${{ number_format(
                                        $detalle->costo_unitario_base,
                                        4
                                    ) }}

                                </span>

                                <p class="text-xs text-gray-400 mt-1">

                                    por {{ $ingrediente->presentacion_unidad }}

                                </p>

                            </td>


                            {{-- ================================= --}}
                            {{-- COSTO DE LA RECETA --}}
                            {{-- ================================= --}}

                            <td class="px-5 py-5 text-right">

                                <span class="font-bold text-blue-700">

                                    ${{ number_format(
                                        $detalle->costo_receta,
                                        2
                                    ) }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>


                {{-- ================================================= --}}
                {{-- TOTAL --}}
                {{-- ================================================= --}}

                <tfoot class="bg-gray-50 border-t-2 border-gray-200">

                    <tr>

                        <td colspan="8"
                            class="px-5 py-5 text-right">

                            <span class="font-bold text-gray-700">

                                Costo total de ingredientes:

                            </span>

                        </td>


                        <td class="px-5 py-5 text-right">

                            <span class="text-xl font-bold text-blue-700">

                                ${{ number_format(
                                    $recetaElaborada->costo_neto,
                                    2
                                ) }}

                            </span>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>


        {{-- ================================================= --}}
        {{-- NOTA EXPLICATIVA --}}
        {{-- ================================================= --}}

        <div class="p-5 border-t border-gray-100">

            <div class="flex gap-3 bg-blue-50 border
                        border-blue-100 rounded-xl p-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01
                        M12 20a8 8 0 100-16 8 8 0 000 16z" />

                </svg>


                <div>

                    <p class="text-sm font-semibold text-blue-800">

                        ¿Cómo se obtiene el costo de cada ingrediente?

                    </p>

                    <p class="text-xs text-blue-700 mt-1 leading-relaxed">

                        El sistema considera la cantidad utilizada en la receta,
                        el tamaño de la presentación, el costo de la presentación
                        y el rendimiento después de aplicar la merma. Con estos
                        datos se determina el costo real y la cantidad que cada
                        ingrediente aporta al costo total de la receta.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- SECCIÓN 6 - EVALUACIÓN FINANCIERA --}}
{{-- ========================================================= --}}

@php

    /*
    |--------------------------------------------------------------------------
    | Valores principales
    |--------------------------------------------------------------------------
    */

    $utilidadDeseada = (float) $recetaElaborada->utilidad_deseada;

    $utilidadReal = (float) $recetaElaborada->utilidad_real_porcentaje;

    $costoObjetivo = (float) $recetaElaborada->costo_objetivo;

    $costoPorPorcion = (float) $recetaElaborada->costo_por_porcion;

    $diferenciaObjetivo = (float) $recetaElaborada->diferencia_objetivo;


    /*
    |--------------------------------------------------------------------------
    | Diferencia de utilidad
    |--------------------------------------------------------------------------
    */

    $diferenciaUtilidad = $utilidadReal - $utilidadDeseada;


    /*
    |--------------------------------------------------------------------------
    | Determinar estado financiero
    |--------------------------------------------------------------------------
    */

    if ($utilidadReal >= $utilidadDeseada) {

        $estadoFinanciero = 'Objetivo alcanzado';

        $estadoDescripcion =
            'La receta alcanza o supera el porcentaje de utilidad deseado.';

        $estadoColor = 'green';

    } elseif ($utilidadReal >= ($utilidadDeseada * 0.80)) {

        $estadoFinanciero = 'Cerca del objetivo';

        $estadoDescripcion =
            'La receta se encuentra cerca de alcanzar la utilidad deseada.';

        $estadoColor = 'yellow';

    } else {

        $estadoFinanciero = 'Por debajo del objetivo';

        $estadoDescripcion =
            'La utilidad obtenida está por debajo del objetivo establecido.';

        $estadoColor = 'red';

    }


    /*
    |--------------------------------------------------------------------------
    | Porcentaje de cumplimiento
    |--------------------------------------------------------------------------
    */

    if ($utilidadDeseada > 0) {

        $cumplimiento =
            ($utilidadReal / $utilidadDeseada) * 100;

    } else {

        $cumplimiento = 100;

    }

    $cumplimientoVisual =
        min(max($cumplimiento, 0), 100);

@endphp


<div class="mt-8">

    {{-- ================================================= --}}
    {{-- TÍTULO --}}
    {{-- ================================================= --}}

    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Evaluación financiera
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Comparación entre los objetivos establecidos y los resultados obtenidos.
        </p>

    </div>


    {{-- ================================================= --}}
    {{-- ESTADO PRINCIPAL --}}
    {{-- ================================================= --}}

    <div
        class="
        mb-6
        rounded-2xl
        border
        p-6
        @if($estadoColor === 'green')
            bg-green-50 border-green-200
        @elseif($estadoColor === 'yellow')
            bg-yellow-50 border-yellow-200
        @else
            bg-red-50 border-red-200
        @endif
        "
    >

        <div class="flex flex-col md:flex-row
                    md:items-center md:justify-between gap-5">


            {{-- ICONO + INFORMACIÓN --}}

            <div class="flex items-center gap-4">

                <div
                    class="
                    w-14 h-14
                    rounded-2xl
                    flex items-center justify-center
                    @if($estadoColor === 'green')
                        bg-green-100
                    @elseif($estadoColor === 'yellow')
                        bg-yellow-100
                    @else
                        bg-red-100
                    @endif
                    "
                >

                    @if($estadoColor === 'green')

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7 text-green-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />

                        </svg>

                    @elseif($estadoColor === 'yellow')

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7 text-yellow-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86
                                L1.82 18a2 2 0 001.71 3h16.94
                                a2 2 0 001.71-3L13.71 3.86
                                a2 2 0 00-3.42 0z" />

                        </svg>

                    @else

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-7 h-7 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    @endif

                </div>


                <div>

                    <p
                        class="
                        text-sm font-medium
                        @if($estadoColor === 'green')
                            text-green-600
                        @elseif($estadoColor === 'yellow')
                            text-yellow-600
                        @else
                            text-red-600
                        @endif
                        "
                    >
                        Evaluación de rentabilidad
                    </p>


                    <h3
                        class="
                        text-2xl font-bold
                        @if($estadoColor === 'green')
                            text-green-800
                        @elseif($estadoColor === 'yellow')
                            text-yellow-800
                        @else
                            text-red-800
                        @endif
                        "
                    >

                        {{ $estadoFinanciero }}

                    </h3>


                    <p
                        class="
                        text-sm mt-1
                        @if($estadoColor === 'green')
                            text-green-700
                        @elseif($estadoColor === 'yellow')
                            text-yellow-700
                        @else
                            text-red-700
                        @endif
                        "
                    >

                        {{ $estadoDescripcion }}

                    </p>

                </div>

            </div>


            {{-- PORCENTAJE DE CUMPLIMIENTO --}}

            <div class="text-center md:text-right">

                <p class="text-sm text-gray-500">
                    Cumplimiento del objetivo
                </p>

                <p
                    class="
                    text-4xl font-bold mt-1
                    @if($estadoColor === 'green')
                        text-green-600
                    @elseif($estadoColor === 'yellow')
                        text-yellow-600
                    @else
                        text-red-600
                    @endif
                    "
                >

                    {{ number_format($cumplimiento, 1) }}%

                </p>

            </div>

        </div>

    </div>



    {{-- ================================================= --}}
    {{-- COMPARACIÓN DE UTILIDAD --}}
    {{-- ================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- ================================================= --}}
        {{-- UTILIDAD --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md
                    border border-gray-100 p-6">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Utilidad
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Objetivo vs resultado real
                    </p>

                </div>


                <div class="w-10 h-10 rounded-xl bg-purple-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-purple-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3v18h18
                            M7 16l4-5 3 3 5-7" />

                    </svg>

                </div>

            </div>


            {{-- UTILIDAD DESEADA --}}

            <div class="flex justify-between items-center mb-2">

                <span class="text-sm text-gray-600">
                    Utilidad deseada
                </span>

                <span class="font-bold text-gray-800">

                    {{ number_format($utilidadDeseada, 2) }}%

                </span>

            </div>


            @php
                $anchoUtilidadDeseada = min(max($utilidadDeseada, 0), 100);
            @endphp

            <div class="w-full h-3 bg-gray-200 rounded-full mb-5 overflow-hidden">

                <div
                    class="h-3 rounded-full transition-all duration-700"
                    style="width: {{ $anchoUtilidadDeseada }}%; background-color: #9ca3af;">
                </div>

            </div>


            {{-- UTILIDAD REAL --}}

            <div class="flex justify-between items-center mb-2">

                <span class="text-sm text-gray-600">
                    Utilidad real
                </span>

                <span
                    class="
                    font-bold
                    @if($estadoColor === 'green')
                        text-green-600
                    @elseif($estadoColor === 'yellow')
                        text-yellow-600
                    @else
                        text-red-600
                    @endif
                    "
                >

                    {{ number_format($utilidadReal, 2) }}%

                </span>

            </div>


            @php
                $anchoUtilidadReal = min(max($utilidadReal, 0), 100);

                if ($estadoColor === 'green') {
                    $colorUtilidadReal = '#22c55e';
                } elseif ($estadoColor === 'yellow') {
                    $colorUtilidadReal = '#eab308';
                } else {
                    $colorUtilidadReal = '#ef4444';
                }
            @endphp

            <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden">

                <div
                    class="h-3 rounded-full transition-all duration-700"
                    style="width: {{ $anchoUtilidadReal }}%; background-color: {{ $colorUtilidadReal }};">
                </div>

            </div>


            {{-- DIFERENCIA --}}

            <div class="mt-6 pt-5 border-t border-gray-100">

                <div class="flex justify-between items-center">

                    <span class="text-sm text-gray-500">
                        Diferencia
                    </span>

                    <span
                        class="
                        font-bold
                        @if($diferenciaUtilidad >= 0)
                            text-green-600
                        @else
                            text-red-600
                        @endif
                        "
                    >

                        @if($diferenciaUtilidad >= 0)
                            +
                        @endif

                        {{ number_format(
                            $diferenciaUtilidad,
                            2
                        ) }} puntos porcentuales

                    </span>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- COSTO OBJETIVO --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl shadow-md
                    border border-gray-100 p-6">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="text-lg font-bold text-gray-800">
                        Costo objetivo
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Comparación del costo permitido por porción
                    </p>

                </div>


                <div class="w-10 h-10 rounded-xl bg-orange-100
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-orange-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2
                            3 2 3 .895 3 2-1.343 2-3 2m0-8
                            V6m0 12v-2" />

                    </svg>

                </div>

            </div>


            {{-- COSTO OBJETIVO --}}

            <div class="flex justify-between items-center
                        py-4 border-b border-gray-100">

                <div>

                    <p class="text-sm font-medium text-gray-700">
                        Costo máximo recomendado
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Según la utilidad deseada
                    </p>

                </div>

                <span class="text-xl font-bold text-blue-600">

                    ${{ number_format(
                        $costoObjetivo,
                        2
                    ) }}

                </span>

            </div>


            {{-- COSTO REAL --}}

            <div class="flex justify-between items-center
                        py-4 border-b border-gray-100">

                <div>

                    <p class="text-sm font-medium text-gray-700">
                        Costo real por porción
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Costo obtenido en la receta
                    </p>

                </div>

                <span class="text-xl font-bold text-gray-800">

                    ${{ number_format(
                        $costoPorPorcion,
                        2
                    ) }}

                </span>

            </div>


            {{-- DIFERENCIA --}}

            <div class="flex justify-between items-center
                        py-4">

                <div>

                    <p class="text-sm font-medium text-gray-700">
                        Diferencia
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Costo real - costo objetivo
                    </p>

                </div>

                <span
                    class="
                    text-xl font-bold
                    @if($diferenciaObjetivo <= 0)
                        text-green-600
                    @else
                        text-red-600
                    @endif
                    "
                >

                    @if($diferenciaObjetivo > 0)
                        +
                    @endif

                    ${{ number_format(
                        $diferenciaObjetivo,
                        2
                    ) }}

                </span>

            </div>


            {{-- INDICADOR --}}

            <div class="mt-2">

                @if($diferenciaObjetivo <= 0)

                    <div class="flex items-center gap-2
                                bg-green-50 text-green-700
                                rounded-xl p-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7" />

                        </svg>

                        <span class="text-sm font-medium">

                            El costo está dentro del objetivo.

                        </span>

                    </div>

                @else

                    <div class="flex items-center gap-2
                                bg-red-50 text-red-700
                                rounded-xl p-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86
                                L1.82 18a2 2 0 001.71 3h16.94
                                a2 2 0 001.71-3L13.71 3.86
                                a2 2 0 00-3.42 0z" />

                        </svg>

                        <span class="text-sm font-medium">

                            El costo supera el objetivo.

                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>



    {{-- ================================================= --}}
    {{-- BARRA DE CUMPLIMIENTO --}}
    {{-- ================================================= --}}

    <div class="mt-6 bg-white rounded-2xl shadow-md
                border border-gray-100 p-6">

        <div class="flex flex-col md:flex-row
                    md:items-center md:justify-between gap-3 mb-4">

            <div>

                <h3 class="font-bold text-gray-800">
                    Cumplimiento de utilidad
                </h3>

                <p class="text-sm text-gray-500">
                    Qué tan cerca está la receta de alcanzar su objetivo.
                </p>

            </div>

            <span class="text-lg font-bold
                @if($estadoColor === 'green')
                    text-green-600
                @elseif($estadoColor === 'yellow')
                    text-yellow-600
                @else
                    text-red-600
                @endif
            ">

                {{ number_format($cumplimiento, 1) }}%

            </span>

        </div>


        {{-- BARRA --}}

        @php
            $anchoCumplimiento = min(max($cumplimientoVisual, 0), 100);

            if ($estadoColor === 'green') {
                $colorCumplimiento = '#22c55e';
            } elseif ($estadoColor === 'yellow') {
                $colorCumplimiento = '#eab308';
            } else {
                $colorCumplimiento = '#ef4444';
            }
        @endphp

        <div class="w-full bg-gray-200 rounded-full h-5 overflow-hidden">

            <div
                class="h-5 rounded-full transition-all duration-1000"
                style="width: {{ $anchoCumplimiento }}%; background-color: {{ $colorCumplimiento }};">
            </div>

        </div>


        {{-- REFERENCIAS --}}

        <div class="flex justify-between mt-2">

            <span class="text-xs text-gray-400">
                0%
            </span>

            <span class="text-xs text-gray-400">
                Objetivo: {{ number_format($utilidadDeseada, 2) }}%
            </span>

            <span class="text-xs text-gray-400">
                100%
            </span>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- SECCIÓN 7 - INTERPRETACIÓN Y RECOMENDACIONES --}}
{{-- ========================================================= --}}

@php

    /*
    |--------------------------------------------------------------------------
    | Determinar recomendación visual
    |--------------------------------------------------------------------------
    */

    $diferenciaObjetivo =
        (float) $recetaElaborada->diferencia_objetivo;

    $utilidadReal =
        (float) $recetaElaborada->utilidad_real_porcentaje;

    $utilidadDeseada =
        (float) $recetaElaborada->utilidad_deseada;


    if ($diferenciaObjetivo <= 0) {

        $recomendacionTitulo = 'La receta es financieramente viable';

        $recomendacionTexto =
            'El costo por porción se encuentra dentro del objetivo establecido y la utilidad obtenida cumple con la meta deseada.';

        $recomendacionTipo = 'success';

    } else {

        $recomendacionTitulo = 'Se recomienda revisar los costos';

        $recomendacionTexto =
            'El costo por porción supera el objetivo establecido. Se recomienda revisar los ingredientes, las mermas y los costos operativos para mejorar la rentabilidad.';

        $recomendacionTipo = 'warning';

    }

@endphp


<div class="mt-8">

    {{-- ================================================= --}}
    {{-- TÍTULO --}}
    {{-- ================================================= --}}

    <div class="mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
            Interpretación y recomendaciones
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            Análisis general del resultado obtenido.
        </p>

    </div>


    {{-- ================================================= --}}
    {{-- INTERPRETACIÓN PRINCIPAL --}}
    {{-- ================================================= --}}

    <div
        class="
        rounded-2xl
        border
        p-6
        @if($recomendacionTipo === 'success')
            bg-green-50 border-green-200
        @else
            bg-yellow-50 border-yellow-200
        @endif
        "
    >

        <div class="flex items-start gap-4">


            {{-- ICONO --}}

            <div
                class="
                w-12 h-12
                rounded-xl
                flex items-center justify-center
                flex-shrink-0
                @if($recomendacionTipo === 'success')
                    bg-green-100
                @else
                    bg-yellow-100
                @endif
                "
            >

                @if($recomendacionTipo === 'success')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-green-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />

                    </svg>

                @else

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-yellow-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86
                            L1.82 18a2 2 0 001.71 3h16.94
                            a2 2 0 001.71-3L13.71 3.86
                            a2 2 0 00-3.42 0z" />

                    </svg>

                @endif

            </div>


            {{-- TEXTO --}}

            <div class="flex-1">

                <h3
                    class="
                    text-lg font-bold
                    @if($recomendacionTipo === 'success')
                        text-green-800
                    @else
                        text-yellow-800
                    @endif
                    "
                >

                    {{ $recomendacionTitulo }}

                </h3>


                <p
                    class="
                    text-sm mt-2 leading-relaxed
                    @if($recomendacionTipo === 'success')
                        text-green-700
                    @else
                        text-yellow-700
                    @endif
                    "
                >

                    {{ $recomendacionTexto }}

                </p>

            </div>

        </div>

    </div>



    {{-- ================================================= --}}
    {{-- INTERPRETACIÓN DEL SISTEMA --}}
    {{-- ================================================= --}}

    <div class="mt-6 bg-white rounded-2xl shadow-md
                border border-gray-100 p-6">

        <div class="flex items-center gap-3 mb-5">

            <div class="w-10 h-10 rounded-xl bg-blue-100
                        flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7
                        a2 2 0 01-2-2V5a2 2 0 012-2h6l5
                        5v11a2 2 0 01-2 2z" />

                </svg>

            </div>


            <div>

                <h3 class="text-lg font-bold text-gray-800">
                    Interpretación del cálculo
                </h3>

                <p class="text-sm text-gray-500">
                    Resultado generado por el sistema.
                </p>

            </div>

        </div>


        <div class="bg-gray-50 rounded-xl p-5
                    border border-gray-100">

            <p class="text-gray-700 leading-relaxed">

                {{ $recetaElaborada->interpretacion }}

            </p>

        </div>

    </div>

    {{-- ================================================= --}}
    {{-- RECOMENDACIONES --}}
    {{-- ================================================= --}}

    @if($utilidadReal >= $utilidadDeseada)

        {{-- ================================================= --}}
        {{-- RECETA RENTABLE --}}
        {{-- ================================================= --}}

        <div class="mt-6 bg-green-50 rounded-2xl shadow-md
                    border border-green-200 p-6">

            <div class="flex items-start gap-4">

                {{-- ICONO --}}
                <div class="w-12 h-12 rounded-xl bg-green-100
                            flex items-center justify-center flex-shrink-0">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-green-600"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                </div>

                {{-- TEXTO --}}
                <div>

                    <h3 class="text-lg font-bold text-green-800">
                        La receta cumple con el objetivo de rentabilidad
                    </h3>

                    <p class="text-sm text-green-700 mt-2 leading-relaxed">

                        La utilidad real obtenida es de

                        <strong>
                            {{ number_format($utilidadReal, 2) }}%
                        </strong>

                        y supera la utilidad deseada de

                        <strong>
                            {{ number_format($utilidadDeseada, 2) }}%
                        </strong>.

                        No se requieren recomendaciones de reducción de costos
                        para alcanzar el objetivo establecido.

                    </p>

                </div>

            </div>

            {{-- RESULTADO --}}
            <div class="mt-5 pt-5 border-t border-green-200">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">


                    {{-- UTILIDAD REAL --}}
                    <div class="bg-white bg-opacity-60 rounded-xl p-4">

                        <p class="text-xs text-green-600 uppercase font-semibold">
                            Utilidad real
                        </p>

                        <p class="text-2xl font-bold text-green-700 mt-1">

                            {{ number_format($utilidadReal, 2) }}%

                        </p>

                    </div>

                    {{-- UTILIDAD DESEADA --}}
                    <div class="bg-white bg-opacity-60 rounded-xl p-4">

                        <p class="text-xs text-green-600 uppercase font-semibold">
                            Utilidad deseada
                        </p>

                        <p class="text-2xl font-bold text-green-700 mt-1">

                            {{ number_format($utilidadDeseada, 2) }}%

                        </p>

                    </div>

                    {{-- DIFERENCIA --}}
                    <div class="bg-white bg-opacity-60 rounded-xl p-4">

                        <p class="text-xs text-green-600 uppercase font-semibold">
                            Supera el objetivo por
                        </p>

                        <p class="text-2xl font-bold text-green-700 mt-1">

                            +{{ number_format(
                                $utilidadReal - $utilidadDeseada,
                                2
                            ) }}%

                        </p>

                    </div>


                </div>

            </div>

        </div>

    @else

        {{-- ================================================= --}}
        {{-- RECETA QUE REQUIERE MEJORAS --}}
        {{-- ================================================= --}}

        <div class="mt-6 bg-white rounded-2xl shadow-md
                    border border-gray-100 p-6">

            <div class="mb-5">

                <h3 class="text-lg font-bold text-gray-800">
                    Recomendaciones
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Acciones que pueden ayudar a mejorar la rentabilidad.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- INGREDIENTES --}}
                <div class="rounded-xl border border-gray-100
                            p-5 bg-gray-50">

                    <div class="w-10 h-10 rounded-lg bg-blue-100
                                flex items-center justify-center mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-blue-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 7H4a2 2 0 00-2 2v9
                                a2 2 0 002 2h16a2 2 0 002-2V9
                                a2 2 0 00-2-2zM8 7V5a4 4 0 018 0v2"
                            />

                        </svg>

                    </div>


                    <h4 class="font-semibold text-gray-800">
                        Revisar ingredientes
                    </h4>


                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">

                        Comparar precios de proveedores y revisar si
                        existen ingredientes cuyo costo tenga un impacto
                        elevado en el costo total de la receta.

                    </p>

                </div>

                {{-- MERMAS --}}
                <div class="rounded-xl border border-gray-100
                            p-5 bg-gray-50">

                    <div class="w-10 h-10 rounded-lg bg-orange-100
                                flex items-center justify-center mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-orange-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01
                                M10.29 3.86L1.82 18a2 2 0
                                001.71 3h16.94a2 2 0
                                001.71-3L13.71 3.86a2
                                2 0 00-3.42 0z"
                            />

                        </svg>

                    </div>


                    <h4 class="font-semibold text-gray-800">
                        Reducir mermas
                    </h4>


                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">

                        Revisar los ingredientes que presentan mayor
                        porcentaje de merma para mejorar el aprovechamiento
                        de la materia prima.

                    </p>

                </div>


                {{-- COSTOS --}}
                <div class="rounded-xl border border-gray-100
                            p-5 bg-gray-50">

                    <div class="w-10 h-10 rounded-lg bg-green-100
                                flex items-center justify-center mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-green-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343
                                2 3 2 3 .895 3 2-1.343 2-3 2m0-8
                                V6m0 12v-2"
                            />

                        </svg>

                    </div>


                    <h4 class="font-semibold text-gray-800">
                        Optimizar costos
                    </h4>


                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">

                        Revisar mano de obra, costos indirectos y gastos
                        de operación para identificar oportunidades
                        de reducción de costos.

                    </p>

                </div>

            </div>

        </div>

    @endif

    {{-- ================================================= --}}
    {{-- RESUMEN FINAL --}}
    {{-- ================================================= --}}

    <div class="mt-6 bg-white rounded-2xl shadow-md
                border border-gray-100 p-6">

        <h3 class="text-lg font-bold text-gray-800 mb-5">
            Resumen de rentabilidad
        </h3>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


            {{-- UTILIDAD DESEADA --}}

            <div class="bg-gray-50 rounded-xl p-4">

                <p class="text-xs text-gray-500 uppercase font-semibold">
                    Utilidad deseada
                </p>

                <p class="text-2xl font-bold text-gray-800 mt-2">

                    {{ number_format(
                        $utilidadDeseada,
                        2
                    ) }}%

                </p>

            </div>


            {{-- UTILIDAD REAL --}}

            <div
                class="
                rounded-xl p-4
                @if($utilidadReal >= $utilidadDeseada)
                    bg-green-50
                @else
                    bg-red-50
                @endif
                "
            >

                <p class="text-xs text-gray-500 uppercase font-semibold">
                    Utilidad real
                </p>

                <p
                    class="
                    text-2xl font-bold mt-2
                    @if($utilidadReal >= $utilidadDeseada)
                        text-green-600
                    @else
                        text-red-600
                    @endif
                    "
                >

                    {{ number_format(
                        $utilidadReal,
                        2
                    ) }}%

                </p>

            </div>


            {{-- COSTO OBJETIVO --}}

            <div class="bg-blue-50 rounded-xl p-4">

                <p class="text-xs text-blue-500 uppercase font-semibold">
                    Costo objetivo
                </p>

                <p class="text-2xl font-bold text-blue-700 mt-2">

                    ${{ number_format(
                        $costoObjetivo,
                        2
                    ) }}

                </p>

            </div>


            {{-- DIFERENCIA --}}

            <div
                class="
                rounded-xl p-4
                @if($diferenciaObjetivo <= 0)
                    bg-green-50
                @else
                    bg-red-50
                @endif
                "
            >

                <p class="text-xs text-gray-500 uppercase font-semibold">
                    Diferencia
                </p>

                <p
                    class="
                    text-2xl font-bold mt-2
                    @if($diferenciaObjetivo <= 0)
                        text-green-600
                    @else
                        text-red-600
                    @endif
                    "
                >

                    @if($diferenciaObjetivo > 0)
                        +
                    @endif

                    ${{ number_format(
                        $diferenciaObjetivo,
                        2
                    ) }}

                </p>

            </div>

        </div>

    </div>



    {{-- ================================================= --}}
    {{-- BOTONES FINALES --}}
    {{-- ================================================= --}}

    <div class="mt-8 flex flex-col sm:flex-row
                justify-end gap-3">


        {{-- VOLVER --}}

        <a
            href="{{ route('recetas.elaboradas.index') }}"
            class="
            inline-flex items-center justify-center
            gap-2
            px-5 py-3
            rounded-xl
            border border-gray-300
            bg-white
            text-gray-700
            font-semibold
            hover:bg-gray-50
            transition
            "
        >

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7" />

            </svg>

            Mis recetas

        </a>



        {{-- NUEVO CÁLCULO --}}

        <a
            href="{{ route(
                'recetas.calcular',
                $recetaElaborada->receta
            ) }}"
            class="
            inline-flex items-center justify-center
            gap-2
            px-5 py-3
            rounded-xl
            bg-blue-600
            text-white
            font-semibold
            hover:bg-blue-700
            transition
            "
        >

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />

            </svg>

            Nuevo cálculo

        </a>



        {{-- IMPRIMIR --}}

        <button
            type="button"
            onclick="window.print()"
            class="
            inline-flex items-center justify-center
            gap-2
            px-5 py-3
            rounded-xl
            bg-gray-800
            text-white
            font-semibold
            hover:bg-gray-900
            transition
            "
        >

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 9V2h12v7M6 18H4a2
                    2 0 01-2-2v-5a2 2 0
                    012-2h16a2 2 0 012 2v5a2
                    2 0 01-2 2h-2M6 14h12v8H6z" />

            </svg>

            Imprimir reporte

        </button>

    </div>

</div>
        

    </div>
</div>

{{-- ========================================================= --}}
{{-- SCRIPT - GRÁFICA DE DISTRIBUCIÓN DE COSTOS --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('distribucionCostosChart');

    if (!canvas) {
        return;
    }

    new Chart(canvas, {

        type: 'doughnut',

        data: {

            labels: [
                'Ingredientes',
                'Mano de obra',
                'Costos indirectos',
                'Gastos de operación'
            ],

            datasets: [{

                data: [

                    {{ $porcentajes['ingredientes'] }},

                    {{ $porcentajes['mano_obra'] }},

                    {{ $porcentajes['indirectos'] }},

                    {{ $porcentajes['operacion'] }}

                ],

                backgroundColor: [

                    '#3b82f6',
                    '#22c55e',
                    '#eab308',
                    '#ef4444'

                ],

                borderWidth: 3,

                borderColor: '#ffffff',

                hoverOffset: 8

            }]

        },


        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 13
                        }
                    }
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' ' +
                                context.label +
                                ': ' +
                                context.parsed +
                                '%';
                        }
                    }
                }
            }
        }
    });
});

</script>

@endsection