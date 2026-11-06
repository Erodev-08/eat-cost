<x-app-layout>

    <div class="bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <span class="text-emerald-700 font-bold uppercase tracking-wider">Eat-Cost</span>
            <span class="text-gray-300">/</span>
            {{-- <span class="text-gray-900 font-medium">Usuario</span>
            <span class="text-gray-300">/</span> --}}
            <span class="text-gray-900 font-medium">Recetas</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold">Nueva Receta</span>
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
                <i class="ri-book-read-line text-lg text-emerald-600"></i>
                Crear nueva receta
            </h1>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-bold mb-1">No se pudo guardar la receta:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="p-8">
            <div class="mx-auto max-w-7xl">
                <form action="{{ route('profile.recetas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                        value="{{ old('nombre_receta') }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all">
                                    @error('nombre_receta')
                                        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5 max-w-lg mx-auto">
                                    <label for="descripcion" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all" style="height: 6rem">{{ old('descripcion') }}</textarea>
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
                                            value="{{ old('cantidad_porciones') }}"
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
                                            <option value="platillos">Platillos</option>
                                            <option value="vasos">Vasos</option>
                                            <option value="rebanadas">Rebanadas</option>
                                            <option value="piezas">Piezas</option>
                                            <option value="porciones">Porciones</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-6 max-w-lg mx-auto">
                                    <label for="procedimiento" class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Procedimiento</label>
                                    <textarea name="procedimiento" id="procedimiento" class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm transition-all" style="height: 7rem">{{ old('procedimiento') }}</textarea>
                                    @error('procedimiento')
                                        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-2 max-w-lg mx-auto">
                                    <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wide">Imagen de la receta</label>
                                </div>
                                <div id="previewContainer" class="aspect-video max-w-lg mx-auto w-full overflow-hidden rounded-xl border-2 border-dashed border-gray-300 hover:border-emerald-400 hover:bg-emerald-50/50 transition-all flex items-center justify-center mb-5 cursor-pointer bg-white"
                                    onclick="document.getElementById('fileInput').click()">
                                    {{-- @if ($receta->imagen)
                                        <img src="{{ asset('storage/' . $receta->imagen) }}" class="w-full h-full object-cover rounded-md" alt="imagen receta">
                                    @else --}}
                                        <div class="text-center">
                                            <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-3">
                                                <i class="ri-image-add-line text-2xl text-emerald-600"></i>
                                            </div>
                                            <p class="text-gray-600 font-medium text-sm">Clic para cambiar imagen</p>
                                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (Max. 2MB)</p>
                                        </div>
                                    {{-- @endif --}}
                                </div>
                                <input type="file" class="hidden" name="imagen" id="fileInput" accept="image/*" onchange="mostrarNombreArchivo(event)">
                                <div id="elementoArchivo" class="mb-5 hidden max-w-lg mx-auto">
                                    <div class="bg-emerald-50 border border-emerald-100 p-3 rounded-xl max-w-lg flex justify-between items-center gap-2">
                                        <div class="flex items-center gap-2 overflow-hidden">
                                            <i class="ri-checkbox-circle-fill text-emerald-500 text-lg"></i>
                                            <p id="nombreArchivo" class="text-sm font-medium text-emerald-800 truncate"></p>
                                        </div>
                                        {{-- <button type="button" id="closeElemento" class="text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 p-1.5 rounded-lg transition-colors" onclick="document.getElementById('fileInput').value = ''; document.getElementById('elementoArchivo').classList.add('hidden'); document.getElementById('previewContainer').innerHTML = '@if($receta->imagen) <img src=\'{{ asset('storage/' . $receta->imagen) }}\' class=\'w-full h-full object-cover rounded-md\'> @else <div class=\'text-center\'><div class=\'w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-3\'><i class=\'ri-image-add-line text-2xl text-emerald-600\'></i></div><p class=\'text-gray-600 font-medium text-sm\'>Clic para cambiar imagen</p><p class=\'text-xs text-gray-400 mt-1\'>PNG, JPG, JPEG (Max. 2MB)</p></div> @endif';">
                                            <i class="ri-close-line text-lg"></i>
                                        </button> --}}
                                        <button type="button" id="closeElemento" class="text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 p-1.5 rounded-lg transition-colors" onclick="document.getElementById('fileInput').value = ''; document.getElementById('elementoArchivo').classList.add('hidden'); document.getElementById('previewContainer').innerHTML = '<div class=\'text-center\'><div class=\'w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-3\'><i class=\'ri-image-add-line text-2xl text-emerald-600\'></i></div><p class=\'text-gray-600 font-medium text-sm\'>Clic para subir imagen</p><p class=\'text-xs text-gray-400 mt-1\'>PNG, JPG, JPEG (Max. 2MB)</p></div>';">
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
                                        Ingredientes
                                    </h2>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Genera y completa los ingredientes necesarios.
                                    </p>
                                </div>

                                {{-- ÁREA SCROLLEABLE --}}
                                <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-6" style="min-height: 400px; max-height: 600px;">

                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="inline-flex gap-2 items-center">
                                                <h3 class="font-bold text-gray-800">
                                                    Ingredientes de la receta
                                                </h3>
                                                <div class="bg-gray-200 px-2 py-1 inline-block rounded-lg" id="ingrediente_cantidad">
                                                    <p id="text_ingrediente_cantidad"> --- </p>
                                                </div>
                                            </div>
                                            
                                            <button
                                                type="button"
                                                onclick="agregarIngrediente()"
                                                class="bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-colors flex items-center gap-1.5">
                                                <i class="ri-add-line"></i>
                                                Añadir
                                            </button>
                                        </div>

                                        <div id="listaIngredientes" class="space-y-4"></div>
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

    </div>
    
</x-app-layout>
