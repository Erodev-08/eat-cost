<x-app-layout>

    <div class="bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <span class="text-emerald-700 font-bold uppercase tracking-wider">Eat-Cost</span>
            <span class="text-gray-300">/</span>
            {{-- <span class="text-gray-900 font-medium">Usuario</span>
            <span class="text-gray-300">/</span> --}}
            <span class="text-gray-900 font-bold">Recetas</span>
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
        <div class="mb-2">
            <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                Mis recetas
            </h1>
        </div>
    </div>

    <div class="py-3 mt-4">
        @if ($recetas->count())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 xl:grid-cols-2 gap-6">
                @foreach ($recetas as $receta)
                    <article class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden flex flex-col sm:flex-row h-full hover:shadow-md transition-shadow">

                        {{-- Imagen --}}
                        <div class="sm:w-56 shrink-0 bg-gray-50">
                            <div class="aspect-[4/3] sm:aspect-auto sm:h-full">
                                @if ($receta->imagen)
                                    <img src="{{ asset('storage/' . $receta->imagen) }}"
                                        alt="{{ $receta->nombre_receta }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover object-center">
                                @else
                                    <div class="w-full h-full min-h-40 flex items-center justify-center text-gray-400">
                                        <div class="text-center">
                                            <i class="ri-image-line text-3xl text-gray-300"></i>
                                            <p class="text-xs font-medium">Sin imagen</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Contenido --}}
                        <div class="flex-1 flex flex-col p-5">
                            <h2 class="text-xl font-bold text-gray-900 line-clamp-2">
                                {{ $receta->nombre_receta }}
                            </h2>

                            <p class="mt-2 text-sm text-gray-600 leading-relaxed line-clamp-3">
                                {{ $receta->descripcion }}
                            </p>

                            <div class="mt-auto pt-4">
                                <a href="{{ route('profile.recetas.show', $receta) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">
                                    <i class="ri-eye-line"></i>
                                    <span>Ver receta</span>
                                </a>
                                <a href="{{ route('profile.recetas.edit', $receta) }}"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                                    <i class="ri-pencil-line"></i>
                                    <span>Editar</span>
                                </a>
                                <a href="#"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-red-500 border border-gray-200 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors"
                                data-delete-action="{{ route('profile.recetas.destroy', $receta) }}"
                                data-delete-name="{{ $receta->nombre_receta }}"
                                onclick="confirmDelete(this)">
                                    <i class="ri-delete-bin-line"></i>
                                    <span>Eliminar</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="mt-8">
                    {{ $recetas->links() }}
                </div>
            </div>
        @else
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-12 text-center max-w-2xl mx-auto mt-10">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ri-book-read-line text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    Aún no hay recetas registradas
                </h2>

                <a href="{{ route('recetas.create') }}"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl py-2.5 px-6 shadow-sm shadow-emerald-600/20 transition-all hover:-translate-y-0.5">
                   <i class="ri-arrow-right-line"></i>
                    <span>Crear una recetas</span>
                </a>
            </div>
        @endif
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

</x-app-layout>
