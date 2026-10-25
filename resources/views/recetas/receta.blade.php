@extends('layouts.plantilla')

@section('title', 'Recetas')

@section('content')

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="mb-8">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                        Mis Recetas
                        <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                    </h1>
                </div>
                @auth
                <div class="mb-8">
                    <a href="{{ route('recetas.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl py-2.5 px-4 shadow-sm shadow-emerald-600/20 transition-all hover:-translate-y-0.5 mt-3">
                        <i class="ri-add-line text-lg"></i>
                        <span>Agregar receta</span>
                    </a>
                </div>
                @endauth
            </div>
            <hr class="mb-8 border-gray-200 border-dashed">
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @foreach ($recetas as $receta)
                <div class="mb-8">
                    <div class="max-w-sm bg-white shadow-sm border border-gray-100 hover:shadow-md transition-shadow mx-auto md:max-w-4xl rounded-2xl overflow-hidden">
                        <div class="md:flex">
                            <div class="shrink-0 w-full md:w-64 lg:w-72 bg-gray-50 flex items-center justify-center overflow-hidden border-b md:border-b-0 md:border-r border-gray-100 relative">
                                <div class="w-full aspect-[4/3] md:h-52 lg:h-60">
                                    @if ($receta->imagen)
                                        <img 
                                            src="{{ asset('storage/' . $receta->imagen) }}"
                                            alt="{{ $receta->nombre_receta }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover object-center transition-transform duration-300 hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 p-4">
                                            <div class="text-center">
                                                <i class="ri-image-line text-2xl mb-1 text-gray-300"></i>
                                                <p class="text-xs font-medium">Sin imagen</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6 md:p-8 flex-1 flex flex-col justify-center">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $receta->nombre_receta }}</h2>
                                <p class="text-gray-600 text-sm mb-6 leading-relaxed">{{ $receta->descripcion }}</p>
                                <div class="flex flex-wrap gap-3 mt-auto">
                                    <a href="{{ route('recetas.show', $receta) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                                        <i class="ri-eye-line"></i>
                                        <span>Ver receta</span>
                                    </a>
                                    <a href="{{ route('recetas.calcular', $receta) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 text-emerald-700 border border-emerald-200 text-sm font-medium rounded-lg hover:bg-emerald-100 transition-colors">
                                        <i class="ri-scales-3-line"></i>
                                        <span>Calcular</span>
                                    </a>
                                    @if(auth()->check() && auth()->id() === $receta->id_usuario)
                                        <a href="{{ route('recetas.edit', $receta) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-gray-700 border border-gray-200 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                            <i class="ri-pencil-line"></i>
                                            <span>Editar</span>
                                        </a>
                                        <button
                                            type="button"   
                                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-red-600 border border-gray-200 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors"
                                            data-delete-action="{{ route('recetas.destroy', $receta) }}"
                                            data-delete-name="{{ $receta->nombre_receta }}"
                                            onclick="confirmDelete(this)">
                                            <i class="ri-delete-bin-line"></i>
                                            <span>Eliminar</span>
                                        </button>
                                    @endif
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
