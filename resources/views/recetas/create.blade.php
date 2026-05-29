@extends('layouts.plantilla')

@section('title', 'Create Receta')

@section('content')
    @if ($errors->any())
        <div class="max-w-7xl mx-auto px-5 mb-6">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3">
                <div class="font-semibold mb-2">Revisa los campos marcados.</div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-blue-900 mb-3 mt-3">
                        Nueva receta
                    </h1>
                    <a href="{{ route('recetas') }}" class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-gray-100 rounded-lg md:py-2 md:px-3 mb-3 mt-3 px-3 py-3">
                        Volver
                    </a>
                </div>
            </div>
            <hr class="mb-5">
        </div>
    </div>

    <div class="px-5 py-3 md:px-5 md:py-4">
        <div class="mx-auto max-w-7xl p-10">
            <form action="{{ route('recetas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden">
                    
                    <!-- Imagen -->
                    <div class="w-full md:w-1/2 bg-gradient-to-br from-[#e8864b] via-[#efad73] to-[#88a07a] flex ">
                        
                        <div class="w-full p-5  justify-center items-center">
                            <div class="mb-5 mx-auto max-w-lg">
                                <h2 class="text-2xl font-bold text-gray-100">
                                    Datos de la receta
                                </h2>
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="nombre_receta" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Nombre</label>
                                <input
                                    type="text"
                                    id="nombre_receta"
                                    name="nombre_receta"
                                    value="{{ old('nombre_receta') }}"
                                    required
                                    class="w-full pr-4 py-3 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                                @error('nombre_receta')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="descripcion" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Descripcion</label>
                                {{-- <input 
                                    type="text" 
                                    placeholder="Nombre de la receta" 
                                    class="w-full pr-4 py-2 rounded-lg border border-gray-400 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"

                                > --}}
                                <textarea name="descripcion" id="descripcion" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="procedimiento" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Procedimiento</label>
                                <textarea name="procedimiento" id="procedimiento" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem">{{ old('procedimiento') }}</textarea>
                                @error('procedimiento')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="previewContainer" class="aspect-video max-w-lg mx-auto w-full overflow-hidden rounded-md border-2 border-dashed border-gray-100 flex items-center justify-center mb-5 cursor-pointer"
                                onclick="document.getElementById('fileInput').click()">
                                <div class="text-center">
                                    <i class="ri-upload-cloud-line text-6xl text-gray-200 mb-2"></i>
                                    <p class="text-gray-200 text-sm">Sin imagen de receta</p>
                                </div>
                            </div>
                            {{-- Input oculto --}}
                            <input type="file" class="hidden" name="imagen" id="fileInput" accept="image/*" onchange="mostrarNombreArchivo(event)">
                            {{-- Nombre del archivo --}}
                            <div id="elementoArchivo" class="mb-5 hidden max-w-lg mx-auto">
                                <div class="bg-teal-300 p-3 rounded-md max-w-lg flex justify-between items-center gap-2">
                                    <p id="nombreArchivo" class=" text-center text-sm text-gray-600 ">  </p>
                                    <a href="#" id="closeElemento" class="hover:bg-teal-400 hover:text-gray-100 p-3 rounded-lg">
                                        <i class="ri-close-line"></i>
                                    </a>
                                </div>
                            </div>
                            @error('imagen')
                                <p class="text-xs text-red-100 mt-1 max-w-lg mx-auto">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="w-full md:w-1/2">
                        <div class="max-w-xl p-5 mx-auto flex flex-col" style="height: 650px; overflow: hidden;">

                            <div class="mb-5 shrink-0">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Agregar una receta
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Genera los ingredientes de la receta y completa sus datos.
                                </p>
                            </div>

                            {{-- ÁREA SCROLLEABLE --}}
                            <div class="pr-2" style="height: 500px; overflow-y: auto;">

                                <div class="mb-5 mx-auto">
                                    <h3 class="font-bold mb-2">Ingredientes</h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        Completa el primer ingrediente y usa el botón para agregar el siguiente.
                                    </p>

                                    <div id="listaIngredientes" class="space-y-3"></div>

                                    <button
                                        type="button"
                                        onclick="agregarIngrediente()"
                                        class="mt-4 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
                                        Añadir ingrediente
                                    </button>
                                </div>

                            </div>

                            {{-- BOTÓN GUARDAR FIJO ABAJO --}}
                            <div class="mt-5 pt-4 border-t shrink-0">
                                <button 
                                    type="submit"
                                    class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                                    Guardar receta
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function mostrarNombreArchivo(event) {
            const input = event.target;

            if (input.files.length > 0) {
                const archivo = input.files[0];
                const nombreElemento = document.getElementById('nombreArchivo');
                const archivoElemento = document.getElementById('elementoArchivo');

                // Mostrar nombre real del archivo
                nombreElemento.textContent = " ✔️ " + archivo.name;

                archivoElemento.classList.remove('hidden');

                // (Opcional) Preview de imagen
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Aquí luego puedes mostrar la imagen si quieres
                    console.log("Imagen cargada");
                    document.getElementById('previewContainer').innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-md">
                    `;
                };
                reader.readAsDataURL(archivo);
            }
        }
        let contadorIngredientes = 0;

        function escapeHtml(valor) {
            return String(valor ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function plantillaIngrediente(indice, ingrediente = {}) {
            return `
                <div class="border rounded-lg p-3 shadow-sm mb-2 bg-gray-50">
                    <p class="text-sm font-semibold mb-2 text-gray-700">
                        Ingrediente ${indice + 1}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <input
                            type="text"
                            name="ingredientes[${indice}][nombre]"
                            value="${escapeHtml(ingrediente.nombre)}"
                            placeholder="Nombre"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="ingredientes[${indice}][cantidad]"
                            value="${escapeHtml(ingrediente.cantidad)}"
                            placeholder="Cantidad usada en receta"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <select
                            name="ingredientes[${indice}][unidad_medida]"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                            <option value="" ${!ingrediente.unidad_medida ? 'selected' : ''}>Unidad usada</option>
                            <option value="gr" ${ingrediente.unidad_medida === 'gr' ? 'selected' : ''}>gr</option>
                            <option value="kg" ${ingrediente.unidad_medida === 'kg' ? 'selected' : ''}>kg</option>
                            <option value="ml" ${ingrediente.unidad_medida === 'ml' ? 'selected' : ''}>ml</option>
                            <option value="l" ${ingrediente.unidad_medida === 'l' ? 'selected' : ''}>l</option>
                            <option value="pza" ${ingrediente.unidad_medida === 'pza' ? 'selected' : ''}>pza</option>
                        </select>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="ingredientes[${indice}][presentacion_cantidad]"
                            value="${escapeHtml(ingrediente.presentacion_cantidad)}"
                            placeholder="Presentación cantidad. Ej: 5000"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <select
                            name="ingredientes[${indice}][presentacion_unidad]"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                            <option value="" ${!ingrediente.presentacion_unidad ? 'selected' : ''}>Unidad presentación</option>
                            <option value="gr" ${ingrediente.presentacion_unidad === 'gr' ? 'selected' : ''}>gr</option>
                            <option value="kg" ${ingrediente.presentacion_unidad === 'kg' ? 'selected' : ''}>kg</option>
                            <option value="ml" ${ingrediente.presentacion_unidad === 'ml' ? 'selected' : ''}>ml</option>
                            <option value="l" ${ingrediente.presentacion_unidad === 'l' ? 'selected' : ''}>l</option>
                            <option value="pza" ${ingrediente.presentacion_unidad === 'pza' ? 'selected' : ''}>pza</option>
                        </select>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="ingredientes[${indice}][costo_presentacion]"
                            value="${escapeHtml(ingrediente.costo_presentacion)}"
                            placeholder="Costo presentación. Ej: 26"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                    </div>
                </div>
            `;
        }

        function agregarIngrediente(ingrediente = {}) {
            const contenedor = document.getElementById('listaIngredientes');
            contenedor.insertAdjacentHTML('beforeend', plantillaIngrediente(contadorIngredientes, ingrediente));
            contadorIngredientes += 1;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const ingredientesIniciales = @json(old('ingredientes', []));

            if (Array.isArray(ingredientesIniciales) && ingredientesIniciales.length > 0) {
                ingredientesIniciales.forEach((ingrediente) => agregarIngrediente(ingrediente));
                return;
            }

            agregarIngrediente();
        });

    </script>

@endsection
