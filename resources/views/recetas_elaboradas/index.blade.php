@extends('layouts.plantilla')

@section('title', 'Mis recetas')

@section('content')

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-blue-900 mb-3">
                Mis recetas
            </h1>

            <p class="text-gray-600">
                Aquí puedes consultar las recetas que ya fueron calculadas.
            </p>
        </div>

        <hr class="mb-8">

        @if ($recetasElaboradas->count())

            <div class="max-w-5xl mx-auto">

        @foreach ($recetasElaboradas as $recetaElaborada)

            <div class="mb-8">
                <div class="max-w-sm bg-white shadow-lg mx-auto md:max-w-4xl rounded-xl overflow-hidden">
                    <div class="md:flex">

                        <div class="shrink-0">
                            @if ($recetaElaborada->receta && $recetaElaborada->receta->imagen)
                                <img
                                    src="{{ asset('storage/' . $recetaElaborada->receta->imagen) }}"
                                    alt="Imagen receta"
                                    class="h-40 w-full md:w-60 md:h-full object-cover">
                            @else
                                <div class="h-40 w-full md:w-60 md:h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    Sin imagen
                                </div>
                            @endif
                        </div>

                        <div class="p-6 w-full">
                            <h2 class="text-xl font-bold mb-2">
                                {{ $recetaElaborada->receta->nombre_receta ?? 'Receta eliminada' }}
                            </h2>

                            <div class="text-sm text-gray-600 space-y-1 mb-4">
                                <p>
                                    <strong>Costo total:</strong>
                                    ${{ number_format($recetaElaborada->costo_total, 2) }}
                                </p>

                                <p>
                                    <strong>Precio venta:</strong>
                                    ${{ number_format($recetaElaborada->precio_venta, 2) }}
                                </p>

                                <p>
                                    <strong>Utilidad real:</strong>
                                    ${{ number_format($recetaElaborada->utilidad_real, 2) }}
                                    ({{ number_format($recetaElaborada->utilidad_real_porcentaje, 2) }}%)
                                </p>

                                <p>
                                    <strong>Fecha:</strong>
                                    {{ $recetaElaborada->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('recetas.elaboradas.show', $recetaElaborada->id_receta_elaborada) }}"
                                class="px-3 py-2 inline-block bg-blue-600 text-white rounded-xl hover:bg-blue-700">
                                    Ver cálculo
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

            <div class="bg-white shadow rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Aún no hay recetas calculadas
                </h2>

                <p class="text-gray-600 mb-5">
                    Cuando calcules una receta, aparecerá en este apartado.
                </p>

                <a href="{{ route('recetas') }}"
                   class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-lg">
                    Ir a recetas
                </a>
            </div>

        @endif

    </div>
</div>

@endsection