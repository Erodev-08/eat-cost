@extends('layouts.plantilla')

@section('title', 'Reporte de cálculo')

@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- ENCABEZADO --}}
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-blue-900 mb-2">
                        Reporte técnico de cálculo
                    </h1>

                    <p class="text-gray-600">
                        Resultado del cálculo realizado para la receta.
                    </p>
                </div>

                <div class="flex gap-3 items-start">
                    <a href="{{ route('recetas.elaboradas.index') }}"
                    class="inline-flex items-center h-fit px-3 py-1.5 text-sm rounded-lg border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                        Volver a Mis recetas
                    </a>

                    <a href="{{ route('recetas') }}"
                    class="inline-flex items-center h-fit px-3 py-1.5 text-sm rounded-lg bg-orange-500 text-white hover:bg-orange-600 transition">
                        Ir a recetas
                    </a>
                </div>
            </div>

            <hr class="mt-6">
        </div>

        {{-- CARD PRINCIPAL --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
            <div class="md:flex">

                {{-- IMAGEN --}}
                <div class="md:w-1/3">
                    @if ($recetaElaborada->receta && $recetaElaborada->receta->imagen)
                        <img src="{{ asset('storage/' . $recetaElaborada->receta->imagen) }}"
                             alt="Imagen receta"
                             class="w-full h-72 md:h-full object-cover">
                    @else
                        <div class="w-full h-72 md:h-full bg-gray-200 flex items-center justify-center text-gray-500">
                            Sin imagen
                        </div>
                    @endif
                </div>

                {{-- INFO RECETA --}}
                <div class="p-6 md:w-2/3">
                    <h2 class="text-3xl font-bold text-gray-800 mb-3">
                        {{ $recetaElaborada->receta->nombre_receta ?? 'Receta eliminada' }}
                    </h2>

                    @if ($recetaElaborada->receta && $recetaElaborada->receta->descripcion)
                        <p class="text-gray-600 mb-4">
                            {{ $recetaElaborada->receta->descripcion }}
                        </p>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-500">Fecha del cálculo</p>
                            <p class="text-lg text-gray-800">
                                {{ $recetaElaborada->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-500">Utilidad deseada</p>
                            <p class="text-lg text-gray-800">
                                {{ number_format($recetaElaborada->utilidad_deseada, 2) }}%
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-500">Precio de venta</p>
                            <p class="text-lg text-gray-800">
                                ${{ number_format($recetaElaborada->precio_venta, 2) }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-500">Precio sin IVA</p>
                            <p class="text-lg text-gray-800">
                                ${{ number_format($recetaElaborada->precio_sin_iva, 2) }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- TARJETAS DE RESULTADOS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

            <div class="bg-white shadow rounded-xl p-5 border-l-4 border-blue-600">
                <p class="text-sm text-gray-500 font-semibold mb-1">
                    Costo neto
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    ${{ number_format($recetaElaborada->costo_neto, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Materia prima
                </p>
            </div>

            <div class="bg-white shadow rounded-xl p-5 border-l-4 border-orange-500">
                <p class="text-sm text-gray-500 font-semibold mb-1">
                    Costo producción
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    ${{ number_format($recetaElaborada->costo_produccion, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Neto + mano de obra + indirectos
                </p>
            </div>

            <div class="bg-white shadow rounded-xl p-5 border-l-4 border-red-500">
                <p class="text-sm text-gray-500 font-semibold mb-1">
                    Costo total
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    ${{ number_format($recetaElaborada->costo_total, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Producción + gastos operación
                </p>
            </div>

            <div class="bg-white shadow rounded-xl p-5 border-l-4 border-green-600">
                <p class="text-sm text-gray-500 font-semibold mb-1">
                    Utilidad real
                </p>
                <p class="text-2xl font-bold text-gray-800">
                    ${{ number_format($recetaElaborada->utilidad_real, 2) }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ number_format($recetaElaborada->utilidad_real_porcentaje, 2) }}%
                </p>
            </div>

        </div>

        {{-- DESGLOSE GENERAL --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            {{-- COSTOS --}}
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-2xl font-bold text-blue-900 mb-5">
                    Desglose de costos
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Costo neto de receta</span>
                        <strong>${{ number_format($recetaElaborada->costo_neto, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Mano de obra</span>
                        <strong>${{ number_format($recetaElaborada->mano_obra, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Costos indirectos</span>
                        <strong>${{ number_format($recetaElaborada->costos_indirectos, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Costo total de producción</span>
                        <strong>${{ number_format($recetaElaborada->costo_produccion, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Gastos de operación</span>
                        <strong>${{ number_format($recetaElaborada->gastos_operacion, 2) }}</strong>
                    </div>

                    <div class="flex justify-between pt-2 text-lg">
                        <span class="font-bold text-gray-800">Costo total más gastos</span>
                        <strong class="text-red-600">
                            ${{ number_format($recetaElaborada->costo_total, 2) }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- RENTABILIDAD --}}
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-2xl font-bold text-blue-900 mb-5">
                    Análisis de rentabilidad
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Precio de venta</span>
                        <strong>${{ number_format($recetaElaborada->precio_venta, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Precio sin IVA</span>
                        <strong>${{ number_format($recetaElaborada->precio_sin_iva, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Utilidad real</span>
                        <strong>${{ number_format($recetaElaborada->utilidad_real, 2) }}</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Utilidad real %</span>
                        <strong>{{ number_format($recetaElaborada->utilidad_real_porcentaje, 2) }}%</strong>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Costo objetivo</span>
                        <strong>${{ number_format($recetaElaborada->costo_objetivo, 2) }}</strong>
                    </div>

                    <div class="flex justify-between pt-2 text-lg">
                        <span class="font-bold text-gray-800">Diferencia objetivo</span>
                        <strong class="{{ $recetaElaborada->diferencia_objetivo > 0 ? 'text-red-600' : 'text-green-600' }}">
                            ${{ number_format($recetaElaborada->diferencia_objetivo, 2) }}
                        </strong>
                    </div>
                </div>
            </div>

        </div>

        {{-- DETALLE DE INGREDIENTES --}}
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
            <h3 class="text-2xl font-bold text-blue-900 mb-5">
                Detalle técnico por ingrediente
            </h3>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Ingrediente</th>
                            <th class="px-4 py-3 text-left">Cantidad usada</th>
                            <th class="px-4 py-3 text-left">Peso bruto</th>
                            <th class="px-4 py-3 text-left">Peso útil</th>
                            <th class="px-4 py-3 text-left">Merma</th>
                            <th class="px-4 py-3 text-left">Rendimiento</th>
                            <th class="px-4 py-3 text-left">Costo real</th>
                            <th class="px-4 py-3 text-left">Costo unitario</th>
                            <th class="px-4 py-3 text-left">Costo receta</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recetaElaborada->ingredientes as $detalle)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 font-semibold text-gray-800">
                                    {{ $detalle->ingrediente->nombre ?? 'Ingrediente eliminado' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ number_format($detalle->cantidad_usada, 2) }}
                                    {{ $detalle->unidad_usada }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ number_format($detalle->peso_bruto, 2) }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ number_format($detalle->peso_util, 2) }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ number_format($detalle->merma_porcentaje, 2) }}%
                                </td>

                                <td class="px-4 py-3">
                                    {{ number_format($detalle->rendimiento * 100, 2) }}%
                                </td>

                                <td class="px-4 py-3">
                                    ${{ number_format($detalle->costo_real, 2) }}
                                </td>

                                <td class="px-4 py-3">
                                    ${{ number_format($detalle->costo_unitario_base, 4) }}
                                </td>

                                <td class="px-4 py-3 font-bold">
                                    ${{ number_format($detalle->costo_receta, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                                    No hay detalle de ingredientes registrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- INTERPRETACIÓN --}}
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
            <h3 class="text-2xl font-bold text-blue-900 mb-4">
                Interpretación del resultado
            </h3>

            <div class="{{ $recetaElaborada->diferencia_objetivo > 0 ? 'bg-red-50 border-red-300 text-red-800' : 'bg-green-50 border-green-300 text-green-800' }} border rounded-xl p-5">
                <p class="text-lg leading-relaxed">
                    {{ $recetaElaborada->interpretacion }}
                </p>
            </div>
        </div>

    </div>
</div>

@endsection