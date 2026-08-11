@extends('layouts.plantilla')

@section('title', 'Calcular receta')

@section('content')

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Hay errores:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        {{-- TITULO --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-blue-900 mb-2">
                Calcular receta
            </h1>

            <p class="text-gray-600">
                {{ $receta->nombre_receta }}
            </p>
        </div>

        {{-- CARD PRINCIPAL --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            {{-- HEADER --}}
            <div class="p-6 border-b border-gray-200">

                <div class="flex flex-col md:flex-row gap-6">

                    {{-- IMAGEN --}}
                    <div class="md:w-1/3">
                        @if ($receta->imagen)
                            <img
                                src="{{ asset('storage/' . $receta->imagen) }}"
                                alt="imagen receta"
                                class="w-full h-64 object-cover rounded-xl">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500">
                                Sin imagen
                            </div>
                        @endif
                    </div>
                    </div>

                    {{-- INFO --}}
                    <div class="md:w-2/3">

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">
                            {{ $receta->nombre_receta }}
                        </h2>

                        <p class="text-gray-600 mb-4">
                            {{ $receta->descripcion }}
                        </p>

                        <div>
                            <h3 class="font-semibold text-lg mb-4">
                                Ingredientes para cálculo
                            </h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-200 rounded-lg">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Ingrediente</th>
                                            <th class="px-4 py-2 text-left">Cantidad usada</th>
                                            <th class="px-4 py-2 text-left">Presentación</th>
                                            <th class="px-4 py-2 text-left">Costo presentación</th>
                                            <th class="px-4 py-2 text-left">Merma %</th>
                                            <th class="px-4 py-2 text-left">Peso útil</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($receta->ingredientes as $ingrediente)
                                            <tr class="border-t">
                                                <td class="px-4 py-2">
                                                    {{ $ingrediente->nombre }}
                                                </td>

                                                <td class="px-4 py-2">
                                                    {{ $ingrediente->pivot->cantidad }}
                                                    {{ $ingrediente->pivot->unidad_medida }}
                                                </td>

                                                <td class="px-4 py-2">
                                                    {{ $ingrediente->presentacion_cantidad }}
                                                    {{ $ingrediente->presentacion_unidad }}
                                                </td>

                                                <td class="px-4 py-2">
                                                    ${{ number_format($ingrediente->costo_presentacion, 2) }}
                                                </td>

                                                <td class="px-4 py-2">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0"
                                                        max="99"
                                                        name="ingredientes[{{ $ingrediente->id_ingrediente }}][merma_porcentaje]"
                                                        value="0"
                                                        class="w-24 border border-gray-300 rounded-lg px-3 py-2">
                                                </td>

                                                <td class="px-4 py-2">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0"
                                                        name="ingredientes[{{ $ingrediente->id_ingrediente }}][peso_util]"
                                                        placeholder="Opcional"
                                                        class="w-28 border border-gray-300 rounded-lg px-3 py-2">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-sm text-gray-500 mt-3">
                                Puedes ingresar la merma (%) o el peso útil. Si ingresas peso útil, el sistema calculará automáticamente el rendimiento.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- FORMULARIO --}}
            <div class="p-6">

                <form action="{{ route('recetas.calcular.store', $receta->slug) }}" method="POST">
                @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- MANO DE OBRA --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mano de obra
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="mano_obra"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                required>
                        </div>

                        {{-- PRODUCCION --}}

                        <div class="bg-blue-50 border rounded-lg p-4 mb-6">
                            <h3 class="font-bold text-lg mb-2">
                                Producción de la receta
                            </h3>

                            <p>
                                Esta receta produce

                                <strong>

                                    {{ $receta->cantidad_porciones }}
                                    {{ strtolower($receta->tipo_porcion) }}

                                </strong>
                            </p>
                            
                        </div>

                        {{-- COSTOS INDIRECTOS --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Costos indirectos
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="costos_indirectos"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                required>
                        </div>

                        {{-- GASTOS OPERACION --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gastos de operación
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="gastos_operacion"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                required>
                        </div>

                        {{-- PRECIO POR PORCION --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Precio de venta por {{ strtolower($receta->tipo_porcion) }}
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="precio_por_porcion"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                required>
                        </div>

                        {{-- UTILIDAD DESEADA --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Utilidad deseada (%)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="utilidad_deseada"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                required>
                        </div>

                    </div>

                    {{-- BOTON --}}
                    <div class="mt-8">

                        <button
                            type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-xl">

                            Generar cálculo

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection