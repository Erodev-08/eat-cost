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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="mb-8">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                        Calcular receta
                        <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                    </h1>
                    <p class="text-gray-500 mt-2 font-medium">
                        {{ $receta->nombre_receta }}
                    </p>
                </div>
                <div class="mb-8">
                    <a href="{{ route('recetas') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all mt-3">
                        <i class="ri-arrow-left-line text-lg"></i>
                        <span>Volver a mis recetas</span>
                    </a>
                </div>
            </div>
            <hr class="mb-5 border-gray-200 border-dashed">
        </div>
    </div>

    <div class="px-5 py-3 md:px-5 md:py-4">
        <div class="mx-auto max-w-7xl">
            {{-- CARD PRINCIPAL --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- HEADER --}}
                <div class="p-8 md:p-10 border-b border-gray-100 bg-gray-50">
                    <div class="flex flex-col md:flex-row gap-8">
                        {{-- IMAGEN --}}
                        <div class="w-full md:w-1/4 max-w-[200px]">
                            <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm aspect-[4/3] bg-gray-50 flex items-center justify-center">
                                @if ($receta->imagen)
                                    <img
                                        src="{{ asset('storage/' . $receta->imagen) }}"
                                        alt="{{ $receta->nombre_receta }}"
                                        class="w-full h-full object-cover object-center">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 p-4">
                                        <i class="ri-image-line text-4xl mb-2 text-gray-300"></i>
                                        <span class="text-sm font-medium">Sin imagen</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- INFO --}}
                        <div class="w-full md:w-2/3 flex flex-col justify-center">
                            <h2 class="text-3xl font-bold text-gray-900 mb-3">
                                {{ $receta->nombre_receta }}
                            </h2>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ $receta->descripcion }}
                            </p>
                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm inline-flex items-center gap-4 max-w-max">
                                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center">
                                    <i class="ri-restaurant-line text-2xl text-emerald-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-1">Rendimiento</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $receta->cantidad_porciones }} {{ strtolower($receta->tipo_porcion) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORMULARIO --}}
                <form action="{{ route('recetas.calcular.store', $receta->slug) }}" method="POST">
                    @csrf
                    
                    <div class="p-8 md:p-10 border-b border-gray-100">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                                <i class="ri-list-check text-xl text-emerald-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Ingredientes para cálculo</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Ingresa la merma (%) o el peso útil. Si ingresas peso útil, el sistema calculará automáticamente el rendimiento.
                                </p>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200">
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Ingrediente</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Cantidad usada</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Presentación</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Costo presentación</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-32">Merma %</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-32">Peso útil</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach ($receta->ingredientes as $ingrediente)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                                                        <i class="ri-leaf-line"></i>
                                                    </div>
                                                    <span class="font-medium text-gray-900">{{ $ingrediente->nombre }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-600 font-medium">
                                                {{ $ingrediente->pivot->cantidad }} {{ $ingrediente->pivot->unidad_medida }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-600 font-medium">
                                                {{ $ingrediente->presentacion_cantidad }} {{ $ingrediente->presentacion_unidad }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right font-semibold text-emerald-600">
                                                ${{ number_format($ingrediente->costo_presentacion, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    max="99"
                                                    name="ingredientes[{{ $ingrediente->id_ingrediente }}][merma_porcentaje]"
                                                    value="0"
                                                    class="w-full text-center border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    name="ingredientes[{{ $ingrediente->id_ingrediente }}][peso_util]"
                                                    placeholder="Opcional"
                                                    class="w-full text-center border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm placeholder-gray-400">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="p-8 md:p-10 bg-gray-50/50">
                        <div class="mb-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                                <i class="ri-calculator-line text-xl text-emerald-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Costos y utilidades</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Completa los siguientes campos para calcular el costo de tu receta.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                    Mano de obra
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="mano_obra"
                                        class="pl-7 w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                        required>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                    Costos indirectos
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="costos_indirectos"
                                        class="pl-7 w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                        required>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                    Gastos de operación
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="gastos_operacion"
                                        class="pl-7 w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                        required>
                                </div>
                            </div>

                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                    Precio de venta/{{ strtolower($receta->tipo_porcion) }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="precio_por_porcion"
                                        class="pl-7 w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                        required>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm lg:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">
                                    Utilidad deseada (%)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">%</span>
                                    </div>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="utilidad_deseada"
                                        class="pr-7 w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-8 py-3.5 rounded-xl shadow-sm transition-all hover:-translate-y-0.5">
                                <i class="ri-calculator-line text-lg"></i>
                                Generar cálculo
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection