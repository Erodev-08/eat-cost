@extends('layouts.plantilla')

@section('title', 'Show Recetas')

@section('content')

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="mb-3 md:mb-8">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                        {{ $receta->nombre_receta }}
                        <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                    </h1>
                    <a href="{{ route('recetas') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2 px-3 shadow-sm transition-all mt-3">
                        <i class="ri-arrow-left-line"></i>
                        <span>Volver</span>
                    </a>
                </div>
                <div class="mb-3 md:mb-8">
                    @if(auth()->check() && auth()->id() === $receta->id_usuario)
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('recetas.edit', $receta) }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                                <i class="ri-pencil-line"></i>
                                <span>Editar</span>
                            </a>
                            <button
                                type="button"
                                class="inline-flex items-center gap-2 bg-white text-red-600 border border-gray-200 hover:bg-red-50 hover:border-red-200 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all"
                                data-delete-action="{{ route('recetas.destroy', $receta) }}"
                                data-delete-name="{{ $receta->nombre_receta }}"
                                onclick="openDeleteModal(this)">
                                <i class="ri-delete-bin-line"></i>
                                <span>Eliminar</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <hr class="mb-5 border-gray-200 border-dashed">
        </div>
    </div>

    <div class="px-5 py-3 md:px-6 md:py-4">
        <div class="max-w-7xl md:max-w-6xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6 md:p-8">
            
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
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center mb-4">
                    <i class="ri-error-warning-line text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Eliminar receta</h3>
                <p class="text-gray-600 mb-4">¿Estás seguro que deseas eliminar "<span id="deleteModalName" class="font-bold text-gray-900"></span>"?</p>
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg border border-red-100 font-medium">
                    Esta acción es irreversible y eliminará todos los datos asociados a la receta.
                </p>
            </div>
            <div class="flex gap-3 p-4 bg-gray-50 border-t border-gray-100">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors">Cancelar</button>
                <form id="deleteModalForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 font-medium transition-colors shadow-sm shadow-red-600/20">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(button) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteModalForm');
            const name = document.getElementById('deleteModalName');

            form.action = button.getAttribute('data-delete-action');
            name.textContent = button.getAttribute('data-delete-name') || 'esta receta';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('deleteModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endsection
