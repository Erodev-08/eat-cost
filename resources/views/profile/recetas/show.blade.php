<x-app-layout>

    <div class="bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <span class="text-emerald-700 font-bold uppercase tracking-wider">Eat-Cost</span>
            <span class="text-gray-300">/</span>
            {{-- <span class="text-gray-900 font-medium">Usuario</span>
            <span class="text-gray-300">/</span> --}}
            <span class="text-gray-900 font-medium">Recetas</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold">{{ $receta->nombre_receta }}</span>
        </div>
        <div class="flex items-center gap-2.5">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                Sesión Activa
            </span>
            <span class="text-xs text-gray-600 font-medium">
                {{ now()->isoFormat('D [de] MMMM, YYYY') }}
            </span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="mb-2">
                <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                    {{ $receta->nombre_receta }}
                </h1>
            </div>
            <div class="mb-2">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profile.recetas') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-arrow-left-line"></i>
                        <span>Volver</span>
                    </a>
                    <a href="{{ route('profile.recetas.edit', $receta) }}" class="inline-flex items-center gap-2 bg-white text-blue-600 border border-gray-200 hover:bg-blue-50 hover:border-blue-200 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-pencil-line"></i>
                        <span>Editar</span>
                    </a>
                    <button 
                        type="button"
                        class="inline-flex items-center gap-2 bg-white text-red-600 border border-gray-200 hover:bg-red-50 hover:border-red-200 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-delete-bin-line"></i>
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto mb-8 bg-emerald-50 rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6 md:p-8">
            
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            
            {{-- Columna Izquierda: Imagen y Descripción --}}
            <div class="space-y-6">
                <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm bg-gray-50 aspect-[16/10] max-h-72 w-full flex items-center justify-center">
                    @if ($receta->imagen)
                        <img 
                            src="{{ asset('storage/' . $receta->imagen) }}"
                            alt="{{ $receta->nombre_receta }}"
                            class="w-full h-full object-cover object-center">
                    @else
                        <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-400 p-8">
                            <div class="text-center">
                                <i class="ri-image-line text-5xl mb-2 text-gray-300"></i>
                                <p class="text-base font-medium">Sin imagen</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <i class="ri-information-line text-emerald-600"></i>
                        Descripción
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $receta->descripcion }}</p>
                </div>
            </div>

            {{-- Columna Derecha: Ingredientes y Procedimiento --}}
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="ri-restaurant-line text-emerald-600"></i>
                        Ingredientes
                    </h3>
                    @if ($receta->ingredientes->count())
                        <ul class="space-y-3">
                            @foreach ($receta->ingredientes as $ingrediente)
                                <li class="flex items-center gap-3 text-gray-700 bg-white p-3 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></div>
                                    <span>{{ $ingrediente->nombre }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">No hay ingredientes registrados</p>
                    @endif
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <i class="ri-list-ordered text-emerald-600"></i>
                        Procedimiento
                    </h3>
                    <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $receta->procedimiento }}</div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>