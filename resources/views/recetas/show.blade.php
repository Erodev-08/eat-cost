@extends('layouts.plantilla')

@section('title', 'Show Recetas')

@section('content')

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:flex items-center justify-between">
                <div class="mb-3 md:mb-8 p-5">
                    <h1 class="text-4xl font-bold text-blue-900 mb-3 mt-3">Receta: {{ $receta->nombre_receta }}</h1> {{-- {{ $receta->name }} --}}
                    <a href="{{ route('recetas') }}" class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-gray-100 rounded-lg md:py-2 md:px-3 mb-3 mt-5 px-3 py-3">Volver</a>
                </div>
                <div class="mb-3 md:mb-8 p-5">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('recetas.edit', $receta) }}" class="bg-blue-700 text-gray-100 hover:bg-blue-900 hover:text-gray-200 rounded-lg md:py-3 md:px-3 px-2 py-3">Editar</a>
                        <button
                            type="button"
                            class="bg-red-600 text-white hover:bg-red-700 rounded-lg md:py-3 md:px-3 px-2 py-3"
                            data-delete-action="{{ route('recetas.destroy', $receta) }}"
                            data-delete-name="{{ $receta->nombre_receta }}"
                            onclick="openDeleteModal(this)">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
            <hr class="mb-5">
        </div>
    </div>

    <div class="px-5 py-3 md:px-6 md:py-4">
        <div class="max-w-7xl md:max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 p-6 md:p-5 ">
            <div class="mb-8">
                @php
                    $suma = 0;
                @endphp
                <h3 class="text-2xl font-bold text-gray-600 mb-3 mt-3">Ingrendientes:</h3>
                @if ($receta->ingredientes->count())
                    <ul class="list-disc list-inside space-y-2 text-lg text-gray-700">
                        @foreach ($receta->ingredientes as $ingrediente)
                            <li>
                                {{ $ingrediente->nombre }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No hay ingredientes registrados</p>
                @endif
            </div>
            <div class="mb-8 w-full border-collapse border border-gray-400">
                <h3 class="text-xl font-bold text-gray-100 mb-3 p-3 bg-gray-600">Procedimiento:</h3>
                <p class="text-lg text-gray-700 mb-3 mt-2 p-3">{{ $receta->procedimiento }}</p>
            </div>
            <div class="mb-8 w-full border-collapse border border-gray-400">
                <h3 class="text-2xl font-bold text-gray-100 mb-3 p-3 bg-gray-600">Descripcion:</h3>
                <p class="text-lg text-gray-700 mb-3 mt-2 p-3">{{ $receta->descripcion }}</p> {{-- {{ $receta->descripcion }} --}}
            </div>
            <div class="mb-8">
                <img 
                {{-- src="https://th.bing.com/th/id/OIP.tzsc10a70pK9ITW5OVR5kgHaD5?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3"  --}}
                src="{{ asset('storage/' . $receta->imagen) }}"
                alt="imagen receta"
                class="w-full rounded-lg" style="height: 30rem">
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Eliminar receta</h3>
                <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <p class="text-gray-600">¿Seguro que deseas eliminar <span id="deleteModalName" class="font-semibold"></span>?</p>
                <p class="text-sm text-gray-500 mt-2">Esta accion no se puede deshacer.</p>
            </div>
            <div class="flex justify-end gap-2 p-4 border-t border-gray-200">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancelar</button>
                <form id="deleteModalForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Eliminar</button>
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
