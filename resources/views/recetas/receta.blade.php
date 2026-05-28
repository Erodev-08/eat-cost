@extends('layouts.plantilla')

@section('title', 'Recetas')

@section('content')

    @if (Session::has('status'))
        <div id="alertOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300">
            <div class="bg-gray-500 rounded-lg shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-100">
                <div class="flex flex-col">
                    <div class="flex items-center justify-between p-4 border-b border-gray-400">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.333 6a3.667 3.667 0 0 1 3.667 3.667v8.666a3.667 3.667 0 0 1 -3.667 3.667h-8.666a3.667 3.667 0 0 1 -3.667 -3.667v-8.666a3.667 3.667 0 0 1 3.667 -3.667zm-3.333 -4c1.094 0 1.828 .533 2.374 1.514a1 1 0 1 1 -1.748 .972c-.221 -.398 -.342 -.486 -.626 -.486h-10c-.548 0 -1 .452 -1 1v9.998c0 .32 .154 .618 .407 .805l.1 .065a1 1 0 1 1 -.99 1.738a3 3 0 0 1 -1.517 -2.606v-10c0 -1.652 1.348 -3 3 -3zm1.293 9.293l-3.293 3.292l-1.293 -1.292a1 1 0 0 0 -1.414 1.414l2 2a1 1 0 0 0 1.414 0l4 -4a1 1 0 0 0 -1.414 -1.414" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 capitalize">
                                @if (Session::get('status') == 'success-receta')
                                    Receta
                                @elseif (Session::get('status') == 'success-receta-update')
                                    Receta
                                @elseif (Session::get('status') == 'success-receta-delete')
                                    Receta
                                @else
                                    {{ Session::get('status') }}
                                @endif
                            </h3>
                        </div>
                        <button onclick="closeAlert()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-400 text-center">
                            @php
                                $status = Session::get('status');
                                $message = match($status) {
                                    'success-receta' => 'Receta guardada correctamente',
                                    'success-receta-update' => 'Receta actualizada correctamente',
                                    'success-receta-delete' => 'Receta eliminada correctamente',
                                    default => $status
                                };
                            @endphp
                            {{ $message }}
                        </p>
                    </div>
                    <div class="flex justify-center p-4 border-t border-gray-400">
                        <button onclick="closeAlert()" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-medium">
                            Entendido
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function closeAlert() {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay) {
                    alertOverlay.style.opacity = '0';
                    setTimeout(() => {
                        alertOverlay.remove();
                    }, 300);
                }
            }
            document.addEventListener('click', function(e) {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay && e.target === alertOverlay) {
                    closeAlert();
                }
            });
        </script>

    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-blue-900 mb-3 mt-3">Recetas</h1>
                </div>
                <div class="mb-8">
                    <a href="{{ route('recetas.create') }}" class="border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-gray-200 rounded-lg md:py-3 md:px-3 mb-3 px-3 py-3 mx-3 mt-3">Agregar receta</a>
                </div>
            </div>
            <hr class="mb-8">
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @foreach ($recetas as $receta)
                <div class="mb-8">
                    <div class="max-w-sm bg-white shadow-lg mx-auto md:max-w-4xl rounded-xl overflow-hidden"> {{-- max-w-md bg-white shadow-lg mx-auto md:max-w-4xl rounded-xl overflow-hidden --}}
                        <div class="md:flex">
                            <div class="shrink-0">
                                <img 
                                src="{{ asset('storage/' . $receta->imagen) }}"
                                alt="imagen receta"
                                class="h-40 w-full md:w-60 md:h-full object-cover">
                            </div>
                            <div class="p-8">
                                <h2 class="text-xl font-bold mb-2">{{ $receta->nombre_receta }}</h2> {{-- {{ $receta->name }} --}}
                                <p class="text-gray-600 text-sm mb-3">{{ $receta->descripcion }}</p> {{-- {{ $receta->descripcion }} --}}
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('recetas.show', $receta) }}" class="px-3 py-2 inline-block bg-green-600 text-white rounded-xl hover:bg-green-700">Ver receta</a>
                                    <a href="{{ route('recetas.edit', $receta) }}" class="px-3 py-2 inline-block bg-blue-600 text-white rounded-xl hover:bg-blue-700">Editar</a>
                                    <button
                                        type="button"
                                        class="px-3 py-2 inline-block bg-red-600 text-white rounded-xl hover:bg-red-700"
                                        data-delete-action="{{ route('recetas.destroy', $receta) }}"
                                        data-delete-name="{{ $receta->nombre_receta }}"
                                        onclick="openDeleteModal(this)">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="mt-8">
                {{ $recetas->links() }}
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
