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
            <div class="flex items-center">
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-blue-900 mb-3 mt-3">
                        Editar receta
                    </h1>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('recetas.show', $receta) }}" class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-gray-100 rounded-lg md:py-2 md:px-3 px-3 py-3">
                            Volver
                        </a>
                        <a href="{{ route('recetas') }}" class="border border-gray-300 text-gray-600 hover:bg-gray-100 rounded-lg md:py-2 md:px-3 px-3 py-3">
                            Lista de recetas
                        </a>
                    </div>
                </div>
            </div>
            <hr class="mb-5">
        </div>
    </div>

    <div class="px-5 py-3 md:px-5 md:py-4">
        <div class="mx-auto max-w-7xl p-10">
            <form action="{{ route('recetas.update', $receta) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="w-full md:w-1/2 bg-gradient-to-br from-[#e8864b] via-[#efad73] to-[#88a07a] flex">
                        <div class="w-full p-5 justify-center items-center">
                            <div class="mb-5 mx-auto max-w-lg">
                                <h2 class="text-2xl font-bold text-gray-100">
                                    Datos de la receta
                                </h2>
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="nombre_receta" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Nombre</label>
                                <input
                                    type="text"
                                    name="nombre_receta"
                                    id="nombre_receta"
                                    value="{{ old('nombre_receta', $receta->nombre_receta) }}"
                                    required
                                    class="w-full pr-4 py-3 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                @error('nombre_receta')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="descripcion" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem">{{ old('descripcion', $receta->descripcion) }}</textarea>
                                @error('descripcion')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">

                            {{-- Cantidad de porciones --}}
                            <div>
                                <label for="cantidad_porciones" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">
                                    Cantidad de porciones
                                </label>

                                <input
                                    type="number"
                                    name="cantidad_porciones"
                                    min="1"
                                    value="{{ old('cantidad_porciones', $receta->cantidad_porciones) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                    required>
                            </div>

                            {{-- Tipo de porción --}}
                            <div>
                                <label for="tipo_porcion" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">
                                    Tipo de porción
                                </label>

                                <select
                                    name="tipo_porcion"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                    required>

                                    <option value="">Selecciona una opción</option>

                                    <option value="platillos"
                                        {{ old('tipo_porcion', $receta->tipo_porcion) == 'platillos' ? 'selected' : '' }}>
                                        Platillos
                                    </option>

                                    <option value="vasos"
                                        {{ old('tipo_porcion', $receta->tipo_porcion) == 'vasos' ? 'selected' : '' }}>
                                        Vasos
                                    </option>

                                    <option value="rebanadas"
                                        {{ old('tipo_porcion', $receta->tipo_porcion) == 'rebanadas' ? 'selected' : '' }}>
                                        Rebanadas
                                    </option>

                                    <option value="piezas"
                                        {{ old('tipo_porcion', $receta->tipo_porcion) == 'piezas' ? 'selected' : '' }}>
                                        Piezas
                                    </option>

                                    <option value="porciones"
                                        {{ old('tipo_porcion', $receta->tipo_porcion) == 'porciones' ? 'selected' : '' }}>
                                        Porciones
                                    </option>

                                </select>
                            </div>
                        </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="procedimiento" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Procedimiento</label>
                                <textarea name="procedimiento" id="procedimiento" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem">{{ old('procedimiento', $receta->procedimiento) }}</textarea>
                                @error('procedimiento')
                                    <p class="text-xs text-red-100 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="previewContainer" class="aspect-video max-w-lg mx-auto w-full overflow-hidden rounded-md border-2 border-dashed border-gray-100 flex items-center justify-center mb-5 cursor-pointer"
                                onclick="document.getElementById('fileInput').click()">
                                @if ($receta->imagen)
                                    <img src="{{ asset('storage/' . $receta->imagen) }}" class="w-full h-full object-cover rounded-md" alt="imagen receta">
                                @else
                                    <div class="text-center">
                                        <i class="ri-upload-cloud-line text-6xl text-gray-200 mb-2"></i>
                                        <p class="text-gray-200 text-sm">Sin imagen de receta</p>
                                    </div>
                                @endif
                            </div>
                            <input type="file" class="hidden" name="imagen" id="fileInput" accept="image/*" onchange="mostrarNombreArchivo(event)">
                            <div id="elementoArchivo" class="mb-5 hidden max-w-lg mx-auto">
                                <div class="bg-teal-300 p-3 rounded-md max-w-lg flex justify-between items-center gap-2">
                                    <p id="nombreArchivo" class="text-center text-sm text-gray-600"></p>
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

                    <div class="w-full md:w-1/2">
                        <div class="max-w-xl p-5 mx-auto flex flex-col" style="height: 650px; overflow: hidden;">

                        <div class="mb-5 shrink-0">
                            <h2 class="text-2xl font-bold text-gray-900">
                                Actualizar receta
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Edita los ingredientes actuales o agrega nuevos ingredientes a la receta.
                            </p>
                        </div>

                        
                        {{-- ÁREA SCROLLEABLE --}}
                        <div class="pr-2" style="height: 500px; overflow-y: auto;">

                            <div class="mb-6">
                                <h3 class="font-bold mb-3 text-gray-800">
                                    Ingredientes de la receta
                                </h3>

                                <div id="listaIngredientes" class="space-y-3">
                                    @if ($receta->ingredientes->count())
                                        @foreach ($receta->ingredientes as $i => $ingrediente)
                                            <div class="border rounded-lg p-3 shadow-sm bg-gray-50">
                                                <p class="text-sm font-semibold mb-2 text-gray-700">
                                                    Ingrediente {{ $i + 1 }}
                                                </p>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                    <input
                                                        type="text"
                                                        name="ingredientes[{{ $i }}][nombre]"
                                                        value="{{ old("ingredientes.$i.nombre", $ingrediente->nombre) }}"
                                                        placeholder="Nombre"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>

                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0.01"
                                                        name="ingredientes[{{ $i }}][cantidad]"
                                                        value="{{ old("ingredientes.$i.cantidad", $ingrediente->pivot->cantidad) }}"
                                                        placeholder="Cantidad usada"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>

                                                    <select
                                                        name="ingredientes[{{ $i }}][unidad_medida]"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>
                                                        <option value="">Unidad usada</option>
                                                        @foreach (['gr', 'kg', 'ml', 'l', 'pza'] as $unidad)
                                                            <option value="{{ $unidad }}"
                                                                @selected(old("ingredientes.$i.unidad_medida", $ingrediente->pivot->unidad_medida) == $unidad)>
                                                                {{ $unidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0.01"
                                                        name="ingredientes[{{ $i }}][presentacion_cantidad]"
                                                        value="{{ old("ingredientes.$i.presentacion_cantidad", $ingrediente->presentacion_cantidad) }}"
                                                        placeholder="Presentación cantidad"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>

                                                    <select
                                                        name="ingredientes[{{ $i }}][presentacion_unidad]"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>
                                                        <option value="">Unidad presentación</option>
                                                        @foreach (['gr', 'kg', 'ml', 'l', 'pza'] as $unidad)
                                                            <option value="{{ $unidad }}"
                                                                @selected(old("ingredientes.$i.presentacion_unidad", $ingrediente->presentacion_unidad) == $unidad)>
                                                                {{ $unidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        min="0.01"
                                                        name="ingredientes[{{ $i }}][costo_presentacion]"
                                                        value="{{ old("ingredientes.$i.costo_presentacion", $ingrediente->costo_presentacion) }}"
                                                        placeholder="Costo presentación"
                                                        class="border border-gray-400 p-2 rounded-lg text-sm"
                                                        required>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500">
                                            No hay ingredientes registrados.
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- AGREGAR INGREDIENTES NUEVOS --}}
                            <div class="mb-5 border-t pt-4">
                                <h3 class="font-bold mb-2 text-gray-800">
                                    Agregar ingredientes
                                </h3>

                                <label class="block text-sm font-semibold mb-1">
                                    ¿Cuántos ingredientes nuevos?
                                </label>

                                <input
                                    type="number"
                                    id="cantidadIngredientes"
                                    min="1"
                                    class="w-full mb-3 border border-gray-400 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Ej: 3">

                                <button
                                    type="button"
                                    onclick="generalIngredientes()"
                                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
                                    Generar ingrediente
                                </button>
                            </div>

                        </div>

                        {{-- BOTÓN GUARDAR FIJO ABAJO --}}
                        <div class="mt-5 pt-4 border-t shrink-0">
                            <button
                                type="submit"
                                class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
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

    let contador = document.querySelectorAll('#listaIngredientes > div').length;

    function generalIngredientes() {
        const contenedor = document.getElementById('listaIngredientes');
        const cantidadInput = document.getElementById('cantidadIngredientes');
        const cantidad = parseInt(cantidadInput.value);

        if (!cantidad || cantidad <= 0) {
            alert('Ingresa una cantidad válida');
            return;
        }

        for (let i = 0; i < cantidad; i++) {
            const index = contador++;

            const html = `
                <div class="border rounded-lg p-3 shadow-sm mb-2 bg-gray-50">
                    <p class="text-sm font-semibold mb-2 text-gray-700">
                        Ingrediente nuevo ${index + 1}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <input
                            type="text"
                            name="ingredientes[${index}][nombre]"
                            placeholder="Nombre"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            name="ingredientes[${index}][cantidad]"
                            placeholder="Cantidad usada"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <select
                            name="ingredientes[${index}][unidad_medida]"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                            <option value="">Unidad usada</option>
                            <option value="gr">gr</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="l">l</option>
                            <option value="pza">pza</option>
                        </select>

                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            name="ingredientes[${index}][presentacion_cantidad]"
                            placeholder="Presentación cantidad"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>

                        <select
                            name="ingredientes[${index}][presentacion_unidad]"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                            <option value="">Unidad presentación</option>
                            <option value="gr">gr</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="l">l</option>
                            <option value="pza">pza</option>
                        </select>

                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            name="ingredientes[${index}][costo_presentacion]"
                            placeholder="Costo presentación"
                            class="border border-gray-400 p-2 rounded-lg text-sm"
                            required>
                    </div>
                </div>
            `;

            contenedor.insertAdjacentHTML('beforeend', html);
        }

        cantidadInput.value = '';
    }
</script>
@endsection
