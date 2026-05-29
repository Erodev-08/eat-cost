@extends('layouts.plantilla')

@section('title', 'Recetas')

@section('content')

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
                                @if ($receta->imagen)
                                    <img 
                                        src="{{ asset('storage/' . $receta->imagen) }}"
                                        alt="imagen receta"
                                        class="h-40 w-full md:w-60 md:h-full object-cover">
                                @else
                                    <div class="h-40 w-full md:w-60 md:h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </div>
                            <div class="p-8">
                                <h2 class="text-xl font-bold mb-2">{{ $receta->nombre_receta }}</h2> {{-- {{ $receta->name }} --}}
                                <p class="text-gray-600 text-sm mb-3">{{ $receta->descripcion }}</p> {{-- {{ $receta->descripcion }} --}}
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('recetas.show', $receta) }}" class="px-3 py-2 inline-block bg-green-600 text-white rounded-xl hover:bg-green-700">Ver receta</a>
                                    <a href="{{ route('recetas.edit', $receta) }}" class="px-3 py-2 inline-block bg-blue-600 text-white rounded-xl hover:bg-blue-700">Editar</a>
                                    <a href="{{ route('recetas.calcular', $receta) }}" class="px-3 py-2 inline-block bg-yellow-500 text-white rounded-xl hover:bg-yellow-600">Calcular receta
                                    </a>
                                    <button
                                    type="button"   
                                    class="px-3 py-2 inline-block bg-red-600 text-white rounded-xl hover:bg-red-700"
                                    data-delete-action="{{ route('recetas.destroy', $receta) }}"
                                    data-delete-name="{{ $receta->nombre_receta }}"
                                    onclick="confirmDelete(this)">
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
<script>
    function confirmDelete(button) {
        const action = button.getAttribute('data-delete-action');
        const name = button.getAttribute('data-delete-name');

        Swal.fire({
            title: '¿Eliminar receta?',
            text: `Estás a punto de eliminar "${name}". Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = action;

                form.innerHTML = `
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                `;

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection
