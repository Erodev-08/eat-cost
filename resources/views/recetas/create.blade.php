@extends('layouts.plantilla')

@section('title', 'Create Receta')

@section('content')
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
                                <label for="name" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Nombre</label>
                                <input 
                                    type="text"
                                    name="nombre_receta" 
                                    class="w-full pr-4 py-3 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="name" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Descripcion</label>
                                {{-- <input 
                                    type="text" 
                                    placeholder="Nombre de la receta" 
                                    class="w-full pr-4 py-2 rounded-lg border border-gray-400 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"

                                > --}}
                                <textarea name="descripcion" id="descripcion" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem"></textarea>
                            </div>

                            <div class="mb-3 max-w-lg mx-auto">
                                <label for="procedimiento" class="block text-xs font-semibold text-gray-100 mb-1.5 uppercase tracking-wide">Procedimiento</label>
                                <textarea name="procedimiento" id="procedimiento" class="w-full pr-4 py-2 rounded-lg border border-gray-600 text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent" style="height: 8rem"></textarea>
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
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="w-full md:w-1/2 justify-center items-center">
                        <div class="max-w-xl p-5 justify-center items-center">
                            <div class="mb-5 mx-auto">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Agregar una receta
                                </h2>
                            </div>

                            <div class="mb-5 mx-auto">
                                <h3 class="font-bold mb-2">Ingredientes</h3>
                                <label class="block text-sm font-seminold mb-1">
                                    ¿Cuántos ingredientes?
                                </label>
                                <input 
                                    type="number"
                                    id="cantidadIngredientes"
                                    min="1"
                                    class="w-full mb-4 border border-gray-400 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Ej: 3">
                                <div id="listaIngredientes" class="grid grid-cols-2 gap-2"></div>
                                <button type="button" onclick="generalIngredientes()"
                                    class="mt-2 bg-gray-200 px-4 py-2 rounded-lg">
                                    General ingrediente
                                </button>
                            </div>

                            <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                                Guardar receta
                            </button>
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
        let contador = 0;
        function generalIngredientes() {
            const contenedor = document.getElementById('listaIngredientes');
            const cantidad = document.getElementById('cantidadIngredientes').value;

            // Limpiar antes de generar nuevos
            contenedor.innerHTML = '';
            contador = 0;

            if (!cantidad || cantidad <= 0) {
                alert('ingresa una cantidad valida');
                return;
            }

            for (let i = 0; i < cantidad; i++) {
                contenedor.insertAdjacentHTML('beforeend', `
                   <div class="border rounded-lg p-3 shadow-sm mb-2">

                        <p class="text-sm font-semibold mb-2 text-gray-700">
                            Ingrediente ${i + 1}
                        </p>

                        <div class="grid grid-cols-2 gap-2">
                            
                            <input type="text" name="ingredientes[${i}][nombre]" placeholder="Nombre"
                                class="border border-gray-400 p-2 rounded-lg text-sm">

                        </div>

                    </div>
                `);
            }
        }

    </script>

@endsection
