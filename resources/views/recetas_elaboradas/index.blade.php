@extends('layouts.plantilla')

@section('title', 'Mis recetas')

@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                Mis recetas
                <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
            </h1>

            <p class="text-gray-600 mt-4">
                Aquí puedes consultar las recetas que ya fueron calculadas.
            </p>
        </div>

        <hr class="mb-8 border-gray-200 border-dashed">

        @if ($recetasElaboradas->count())

            <div class="max-w-5xl mx-auto">

        @foreach ($recetasElaboradas as $recetaElaborada)

            <div class="mb-8">
                <div class="max-w-sm bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow mx-auto md:max-w-4xl rounded-2xl overflow-hidden">
                    <div class="md:flex">

                        <div class="shrink-0 w-full md:w-1/3 bg-gray-50 overflow-hidden border-b md:border-b-0 md:border-r border-gray-100 relative">
                            <div class="w-full aspect-[4/3] md:h-full md:aspect-auto">
                                @if ($recetaElaborada->receta && $recetaElaborada->receta->imagen)
                                    <img
                                        src="{{ asset('storage/' . $recetaElaborada->receta->imagen) }}"
                                        alt="Imagen receta"
                                        class="h-full w-full object-cover object-center">
                                @else
                                    <div class="h-full w-full bg-gray-50 flex items-center justify-center text-gray-400">
                                        <div class="text-center">
                                            <i class="ri-image-line text-3xl mb-2"></i>
                                            <p class="text-sm">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 md:p-6 flex-1 flex flex-col justify-center">
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                {{ $recetaElaborada->receta->nombre_receta ?? 'Receta eliminada' }}
                            </h2>

                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500 mb-1">Costo total</p>
                                    <p class="text-lg font-semibold text-gray-900">${{ number_format($recetaElaborada->costo_total, 2) }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500 mb-1">Precio venta</p>
                                    <p class="text-lg font-semibold text-gray-900">${{ number_format($recetaElaborada->precio_venta, 2) }}</p>
                                </div>
                                <div class="bg-emerald-50 rounded-xl p-3 border border-emerald-100 col-span-2 sm:col-span-1">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 mb-1">Utilidad real</p>
                                    <p class="text-lg font-bold text-emerald-700">
                                        ${{ number_format($recetaElaborada->utilidad_real, 2) }}
                                        <span class="text-sm font-medium ml-1">({{ number_format($recetaElaborada->utilidad_real_porcentaje, 2) }}%)</span>
                                    </p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 col-span-2 sm:col-span-1 flex flex-col justify-center">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-500 mb-1">Fecha</p>
                                    <p class="text-sm font-medium text-gray-700">{{ $recetaElaborada->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('recetas.elaboradas.show', $recetaElaborada->id_receta_elaborada) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                                    <i class="ri-scales-3-line"></i>
                                    <span>Ver cálculo</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

    </div>

            <div class="mt-8">
                {{ $recetasElaboradas->links() }}
            </div>

        @else

            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-12 text-center max-w-2xl mx-auto mt-10">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-book-read-line text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Aún no hay recetas calculadas
                </h2>

                <p class="text-gray-500 mb-8 max-w-sm mx-auto">
                    Cuando calcules el costo y rendimiento de una receta, los resultados aparecerán en este apartado.
                </p>

                <a href="{{ route('recetas') }}"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl py-2.5 px-6 shadow-sm shadow-emerald-600/20 transition-all hover:-translate-y-0.5">
                   <i class="ri-arrow-right-line"></i>
                    <span>Ir a mis recetas</span>
                </a>
            </div>

        @endif

    </div>
</div>

@endsection