@extends('layouts.plantilla')

@section('title', 'Editar Receta')

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
            <div class="flex items-center justify-between">
                <div class="mb-8">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 mt-3 tracking-tight">
                        Editar receta
                        <span class="block h-1.5 w-16 bg-emerald-500 rounded-full mt-2"></span>
                    </h1>
                </div>
                <div class="mb-8 flex flex-wrap gap-3 mt-3">
                    <a href="{{ route('recetas.show', $receta) }}" class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-eye-line text-lg"></i>
                        <span>Ver receta</span>
                    </a>
                    <a href="{{ route('recetas') }}" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 font-medium rounded-xl py-2.5 px-4 shadow-sm transition-all">
                        <i class="ri-list-unordered text-lg"></i>
                        <span>Lista de recetas</span>
                    </a>
                </div>
            </div>
            <hr class="mb-5 border-gray-200 border-dashed">
        </div>
    </div>

    <div class="px-5 py-3 md:px-5 md:py-4">
        <div class="mx-auto max-w-7xl">
            <form action="{{ route('recetas.update', $receta) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="w-full md:w-1/2 bg-gray-50 border-r border-gray-100 flex">
                        <div class="w-full p-8 md:p-10 justify-center items-center">
                            <div class="mb-8 mx-auto max-w-lg">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Datos de la receta
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Actualiza la información básica y la imagen de tu receta.
                                </p>
                            </div>

                            <div class="mb-5 max-w-lg mx-auto">
                                <label for="nombre_receta" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Nombre</label>
                                <input
                                    type="text"
                                    name="nombre_receta"
                                    id="nombre_receta"
                                    value="{{ old('nombre_receta', $receta->nombre_receta) }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all">
                                @error('nombre_receta')
                                    <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5 max-w-lg mx-auto">
                                <label for="descripcion" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all" style="height: 6rem">{{ old('descripcion', $receta->descripcion) }}</textarea>
                                @error('descripcion')
                                    <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-5 max-w-lg mx-auto">
                                <div>
                                    <label for="cantidad_porciones" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">
                                        Cantidad de porciones
                                    </label>
                                    <input
                                        type="number"
                                        name="cantidad_porciones"
                                        min="1"
                                        value="{{ old('cantidad_porciones', $receta->cantidad_porciones) }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all"
                                        required>
                                </div>
                                <div>
                                    <label for="tipo_porcion" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">
                                        Tipo de porción
                                    </label>
                                    <select
                                        name="tipo_porcion"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all appearance-none"
                                        required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="platillos" {{ old('tipo_porcion', $receta->tipo_porcion) == 'platillos' ? 'selected' : '' }}>Platillos</option>
                                        <option value="vasos" {{ old('tipo_porcion', $receta->tipo_porcion) == 'vasos' ? 'selected' : '' }}>Vasos</option>
                                        <option value="rebanadas" {{ old('tipo_porcion', $receta->tipo_porcion) == 'rebanadas' ? 'selected' : '' }}>Rebanadas</option>
                                        <option value="piezas" {{ old('tipo_porcion', $receta->tipo_porcion) == 'piezas' ? 'selected' : '' }}>Piezas</option>
                                        <option value="porciones" {{ old('tipo_porcion', $receta->tipo_porcion) == 'porciones' ? 'selected' : '' }}>Porciones</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-6 max-w-lg mx-auto">
                                <label for="procedimiento" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Procedimiento</label>
                                <textarea name="procedimiento" id="procedimiento" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all" style="height: 7rem">{{ old('procedimiento', $receta->procedimiento) }}</textarea>
                                @error('procedimiento')
                                    <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-2 max-w-lg mx-auto">
                                <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Imagen de la receta</label>
                            </div>
                            <div id="previewContainer" class="aspect-video max-w-lg mx-auto w-full overflow-hidden rounded-xl border-2 border-dashed border-gray-300 hover:border-emerald-400 hover:bg-emerald-50/50 transition-all flex items-center justify-center mb-5 cursor-pointer bg-white"
                                onclick="document.getElementById('fileInput').click()">
                                @if ($receta->imagen)
                                    <img src="{{ asset('storage/' . $receta->imagen) }}" class="w-full h-full object-cover rounded-md" alt="imagen receta">
                                @else
                                    <div class="text-center">
                                        <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-3">
                                            <i class="ri-image-add-line text-2xl text-emerald-600"></i>
                                        </div>
                                        <p class="text-gray-600 font-medium text-sm">Clic para cambiar imagen</p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                @endif
                            </div>
                            <input type="file" class="hidden" name="imagen" id="fileInput" accept="image/*" onchange="mostrarNombreArchivo(event)">
                            <div id="elementoArchivo" class="mb-5 hidden max-w-lg mx-auto">
                                <div class="bg-emerald-50 border border-emerald-100 p-3 rounded-xl max-w-lg flex justify-between items-center gap-2">
                                    <div class="flex items-center gap-2 overflow-hidden">
                                        <i class="ri-checkbox-circle-fill text-emerald-500 text-lg"></i>
                                        <p id="nombreArchivo" class="text-sm font-medium text-emerald-800 truncate"></p>
                                    </div>
                                    <button type="button" id="closeElemento" class="text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 p-1.5 rounded-lg transition-colors" onclick="document.getElementById('fileInput').value = ''; document.getElementById('elementoArchivo').classList.add('hidden'); document.getElementById('previewContainer').innerHTML = '@if($receta->imagen) <img src=\'{{ asset('storage/' . $receta->imagen) }}\' class=\'w-full h-full object-cover rounded-md\'> @else <div class=\'text-center\'><div class=\'w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-3\'><i class=\'ri-image-add-line text-2xl text-emerald-600\'></i></div><p class=\'text-gray-600 font-medium text-sm\'>Clic para cambiar imagen</p><p class=\'text-xs text-gray-400 mt-1\'>PNG, JPG, JPEG (Max. 2MB)</p></div> @endif';">
                                        <i class="ri-close-line text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            @error('imagen')
                                <p class="text-xs text-red-500 mt-1.5 font-medium max-w-lg mx-auto">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 flex flex-col bg-white">
                        <div class="p-8 md:p-10 flex flex-col h-full">

                            <div class="mb-8 shrink-0">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Actualizar receta
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Edita los ingredientes actuales o agrega nuevos ingredientes a la receta.
                                </p>
                            </div>

                            {{-- ÁREA SCROLLEABLE --}}
                            <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-6" style="min-height: 400px; max-height: 600px;">

                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="font-bold text-gray-800">
                                            Ingredientes de la receta
                                        </h3>
                                        <button
                                            type="button"
                                            onclick="agregarIngrediente()"
                                            class="bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-colors flex items-center gap-1.5">
                                            <i class="ri-add-line"></i>
                                            Añadir
                                        </button>
                                    </div>

                                    <div id="listaIngredientes" class="space-y-4">
                                        @if ($receta->ingredientes->count())
                                            @foreach ($receta->ingredientes as $i => $ingrediente)
                                                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                                                    <p class="text-sm font-bold mb-3 text-emerald-800 flex items-center gap-2">
                                                        <i class="ri-restaurant-line"></i>
                                                        Ingrediente {{ $i + 1 }}
                                                    </p>

                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                        <div class="md:col-span-2">
                                                            <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Nombre</label>
                                                            <input
                                                                type="text"
                                                                name="ingredientes[{{ $i }}][nombre]"
                                                                value="{{ old("ingredientes.$i.nombre", $ingrediente->nombre) }}"
                                                                placeholder="Nombre del ingrediente"
                                                                class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                                                required>
                                                        </div>

                                                        <div>
                                                            <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Unidad</label>
                                                            <select
                                                                name="ingredientes[{{ $i }}][unidad_medida]"
                                                                class="unidad-medida w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
                                                                required>
                                                                <option value="">Selecciona unidad</option>
                                                                @foreach (['gr', 'kg', 'ml', 'l', 'pza'] as $unidad)
                                                                    <option value="{{ $unidad }}"
                                                                        @selected(old("ingredientes.$i.unidad_medida", $ingrediente->pivot->unidad_medida) == $unidad)>
                                                                        {{ $unidad }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Cantidad</label>
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                min="0.01"
                                                                name="ingredientes[{{ $i }}][cantidad]"
                                                                value="{{ old("ingredientes.$i.cantidad", $ingrediente->pivot->cantidad) }}"
                                                                placeholder="Ej. 250"
                                                                class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                                                required>
                                                        </div>

                                                        <div>
                                                            <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Unidad presentación</label>
                                                            <select
                                                                class="presentacion-unidad w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
                                                                data-auto-sync="true"
                                                                disabled
                                                                required>
                                                                @foreach (['gr', 'kg', 'ml', 'l', 'pza'] as $unidad)
                                                                    <option value="{{ $unidad }}"
                                                                        @selected(old("ingredientes.$i.unidad_medida", $ingrediente->pivot->unidad_medida) == $unidad)>
                                                                        {{ $unidad }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input
                                                                type="hidden"
                                                                name="ingredientes[{{ $i }}][presentacion_unidad]"
                                                                value="{{ old("ingredientes.$i.unidad_medida", $ingrediente->pivot->unidad_medida) }}"
                                                                class="presentacion-unidad-hidden">
                                                        </div>

                                                        <div>
                                                            <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Cantidad presentación</label>
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                min="0.01"
                                                                name="ingredientes[{{ $i }}][presentacion_cantidad]"
                                                                value="{{ old("ingredientes.$i.presentacion_cantidad", $ingrediente->presentacion_cantidad) }}"
                                                                placeholder="Ej. 1"
                                                                class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                                                required>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-6 text-center">
                                                <i class="ri-list-check text-3xl text-gray-300 mb-2"></i>
                                                <p class="text-sm text-gray-500">
                                                    No hay ingredientes registrados.
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- BOTÓN GUARDAR FIJO ABAJO --}}
                            <div class="pt-6 border-t border-gray-100 shrink-0 mt-6">
                                <button
                                    type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-emerald-600 text-white px-6 py-3.5 rounded-xl font-semibold shadow-sm hover:bg-emerald-700 transition-all hover:-translate-y-0.5">
                                    <i class="ri-save-line text-lg"></i>
                                    Guardar cambios
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

            nombreElemento.textContent = " ✔️ " + archivo.name;
            archivoElemento.classList.remove('hidden');

            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewContainer').innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover rounded-md">
                `;
            };

            reader.readAsDataURL(archivo);
        }
    }

    let contadorIngredientes = document.querySelectorAll('#listaIngredientes > div.border').length;

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
            <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm mb-3">
                <p class="text-sm font-bold mb-3 text-emerald-800 flex items-center gap-2">
                    <i class="ri-restaurant-line"></i>
                    Ingrediente nuevo ${indice + 1}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Nombre</label>
                        <input
                            type="text"
                            name="ingredientes[${indice}][nombre]"
                            value="${escapeHtml(ingrediente.nombre)}"
                            placeholder="Nombre del ingrediente"
                            class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Unidad</label>
                        <select
                            name="ingredientes[${indice}][unidad_medida]"
                            class="unidad-medida w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
                            required>
                            <option value="" ${!ingrediente.unidad_medida ? 'selected' : ''}>Selecciona unidad</option>
                            <option value="gr" ${ingrediente.unidad_medida === 'gr' ? 'selected' : ''}>gr</option>
                            <option value="kg" ${ingrediente.unidad_medida === 'kg' ? 'selected' : ''}>kg</option>
                            <option value="ml" ${ingrediente.unidad_medida === 'ml' ? 'selected' : ''}>ml</option>
                            <option value="l" ${ingrediente.unidad_medida === 'l' ? 'selected' : ''}>l</option>
                            <option value="pza" ${ingrediente.unidad_medida === 'pza' ? 'selected' : ''}>pza</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Cantidad</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            name="ingredientes[${indice}][cantidad]"
                            value="${escapeHtml(ingrediente.cantidad)}"
                            placeholder="Ej. 250"
                            class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Unidad presentación</label>
                        <select
                            class="presentacion-unidad w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
                            data-auto-sync="true"
                            disabled
                            required>
                            <option value="gr" ${ingrediente.unidad_medida === 'gr' ? 'selected' : ''}>gr</option>
                            <option value="kg" ${ingrediente.unidad_medida === 'kg' ? 'selected' : ''}>kg</option>
                            <option value="ml" ${ingrediente.unidad_medida === 'ml' ? 'selected' : ''}>ml</option>
                            <option value="l" ${ingrediente.unidad_medida === 'l' ? 'selected' : ''}>l</option>
                            <option value="pza" ${ingrediente.unidad_medida === 'pza' ? 'selected' : ''}>pza</option>
                        </select>
                        <input
                            type="hidden"
                            name="ingredientes[${indice}][presentacion_unidad]"
                            value="${escapeHtml(ingrediente.unidad_medida)}"
                            class="presentacion-unidad-hidden">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wide mb-1">Cantidad presentación</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            name="ingredientes[${indice}][presentacion_cantidad]"
                            value="${escapeHtml(ingrediente.presentacion_cantidad)}"
                            placeholder="Ej. 1"
                            class="w-full border border-gray-200 p-2.5 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            required>
                    </div>

                </div>
            </div>
        `;
    }

    function agregarIngrediente(ingrediente = {}) {
        const contenedor = document.getElementById('listaIngredientes');
        contenedor.insertAdjacentHTML('beforeend', plantillaIngrediente(contadorIngredientes, ingrediente));
        contadorIngredientes += 1;
    }

    document.addEventListener('change', function (event) {
        const target = event.target;

        if (target.classList.contains('unidad-medida')) {
            const contenedor = target.closest('.bg-white.border');
            if (!contenedor) return;

            const presentacion = contenedor.querySelector('.presentacion-unidad');
            const presentacionHidden = contenedor.querySelector('.presentacion-unidad-hidden');
            if (presentacion && presentacionHidden) {
                presentacion.value = target.value;
                presentacionHidden.value = target.value;
            }
        }
    });
</script>
@endsection
