<x-app-layout>

    {{-- Top Breadcrumb Bar --}}
    <div class="bg-white border-b border-gray-200 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <span class="text-emerald-700 font-bold uppercase tracking-wider">Eat-Cost</span>
            <span class="text-gray-300">/</span>
            <span class="text-gray-900 font-bold">Inicio</span>
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

        {{-- Success Alert --}}
        @if (Session::has('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3 text-emerald-900 shadow-xs">
                <i class="ri-checkbox-circle-fill text-emerald-700 text-lg"></i>
                <div class="text-xs sm:text-sm font-bold">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif

        {{-- Fresh Green Hero Welcome Banner --}}
        <div class="bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 rounded-3xl p-6 sm:p-8 text-white shadow-md shadow-emerald-700/15 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
            
            {{-- Decorative Shapes --}}
            <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="space-y-2 max-w-2xl relative z-10">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-white text-xs font-bold backdrop-blur-xs">
                    <i class="ri-restaurant-2-line text-sm"></i>
                    Panel de Control Gastronómico
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">
                    ¡Bienvenido, {{ Auth::user()->name }}!
                </h1>
                <p class="text-xs sm:text-sm text-emerald-50 leading-relaxed font-medium">
                    Calcula los costos reales de tus recetas con mermas aplicadas, estandariza tus porciones y maximiza el margen de ganancia de tu cocina.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0 relative z-10">
                <a href="{{ route('recetas.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-emerald-800 text-xs font-bold shadow-sm hover:bg-emerald-50 transition-colors">
                    <i class="ri-add-circle-line text-base"></i>
                    <span>Nueva Receta</span>
                </a>
                <a href="{{ route('recetas.elaboradas.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-800/70 hover:bg-emerald-800 text-white text-xs font-bold border border-white/20 transition-colors">
                    <i class="ri-scales-3-line text-base"></i>
                    <span>Costeo & Mermas</span>
                </a>
            </div>
        </div>

        {{-- Metrics & Key Stats Row (Clean White & Green Cards) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Metric 1: Recetas Creadas --}}
            <div class="bg-white rounded-2xl p-4.5 border border-gray-200/80 shadow-xs hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Recetas Registradas</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            {{ $recetasCount ?? 0 }}
                        </h3>
                        <a href="{{ route('recetas') }}" class="inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-1.5">
                            Ver catálogo <i class="ri-arrow-right-s-line ml-0.5"></i>
                        </a>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl border border-emerald-100">
                        <i class="ri-book-read-line"></i>
                    </div>
                </div>
            </div>

            {{-- Metric 2: Cálculos Realizados --}}
            <div class="bg-white rounded-2xl p-4.5 border border-gray-200/80 shadow-xs hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Costeos Realizados</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            {{ $calculosCount ?? 0 }}
                        </h3>
                        <a href="{{ route('recetas.elaboradas.index') }}" class="inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-1.5">
                            Ver elaboraciones <i class="ri-arrow-right-s-line ml-0.5"></i>
                        </a>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl border border-teal-100">
                        <i class="ri-scales-3-line"></i>
                    </div>
                </div>
            </div>

            {{-- Metric 3: Ingredientes --}}
            <div class="bg-white rounded-2xl p-4.5 border border-gray-200/80 shadow-xs hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Ingredientes Activos</p>
                        <h3 class="text-2xl font-black text-gray-900 mt-1">
                            {{ $ingredientesCount ?? 0 }}
                        </h3>
                        <span class="text-xs text-gray-500 mt-1.5 inline-block font-medium">
                            Insumos registrados
                        </span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-green-50 text-green-700 flex items-center justify-center text-xl border border-green-100">
                        <i class="ri-leaf-line"></i>
                    </div>
                </div>
            </div>

            {{-- Metric 4: Usuario / Rol --}}
            <div class="bg-white rounded-2xl p-4.5 border border-gray-200/80 shadow-xs hover:border-emerald-200 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-gray-600 uppercase tracking-wider">Rol de Cuenta</p>
                        <h3 class="text-lg font-black text-gray-900 mt-1 capitalize">
                            {{ Auth::user()->rol ?? 'Estudiante' }}
                        </h3>
                        <a href="{{ route('profile.user') }}" class="inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800 mt-1.5">
                            Ver mi perfil <i class="ri-arrow-right-s-line ml-0.5"></i>
                        </a>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl border border-emerald-100">
                        <i class="ri-user-star-line"></i>
                    </div>
                </div>
            </div>

        </div>

        {{-- Main Dashboard Body (2 Columns) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Left Column: Recetas Recientes & Accesos --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Recent Recipes Card --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                                <i class="ri-book-open-line"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-gray-900">Mis Recetas Recientes</h2>
                                <p class="text-xs text-gray-500 font-medium">Recetas creadas en tu recetario</p>
                            </div>
                        </div>
                        <a href="{{ route('recetas') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                            Ver catálogo completo <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <div class="p-5">
                        @if(isset($recentRecetas) && $recentRecetas->count() > 0)
                            <div class="divide-y divide-gray-100">
                                @foreach($recentRecetas as $receta)
                                    <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between gap-4 group">
                                        <div class="flex items-center gap-3 min-w-0">
                                            @if($receta->imagen)
                                                <img src="{{ asset('storage/' . $receta->imagen) }}" alt="{{ $receta->nombre_receta }}" class="w-16 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0">
                                            @else
                                                <div class="w-16 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                                                    <i class="ri-restaurant-line text-lg"></i>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <a href="{{ route('recetas.show', $receta) }}" class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition-colors truncate block">
                                                    {{ $receta->nombre_receta }}
                                                </a>
                                                <p class="text-xs text-gray-500 truncate mt-0.5 font-medium">
                                                    {{ $receta->porciones ? $receta->porciones . ' porciones' : 'Porciones no asignadas' }} • {{ $receta->created_at ? $receta->created_at->format('d/m/Y') : '' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 shrink-0">
                                            <a href="{{ route('recetas.calcular', $receta) }}" title="Calcular Costo" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700 transition-colors flex items-center gap-1">
                                                <i class="ri-scales-3-line"></i>
                                                <span>Costear</span>
                                            </a>
                                            <a href="{{ route('recetas.show', $receta) }}" class="p-1.5 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                                                <i class="ri-arrow-right-s-line text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Empty State --}}
                            <div class="text-center py-8">
                                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mx-auto mb-2.5">
                                    <i class="ri-book-open-line"></i>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Aún no has creado recetas</h3>
                                <p class="text-xs text-gray-600 mt-1 max-w-sm mx-auto leading-relaxed">
                                    Comienza agregando tu primera receta para calcular sus ingredientes y costo por porción.
                                </p>
                                <a href="{{ route('recetas.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 mt-3.5 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                                    <i class="ri-add-line"></i> Crear Primera Receta
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Fast Actions Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('recetas.create') }}" class="p-4.5 rounded-2xl bg-white border border-gray-200/80 hover:border-emerald-300 hover:shadow-xs transition-all group flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl group-hover:scale-105 transition-transform shrink-0">
                            <i class="ri-add-circle-line"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">Registrar Nueva Receta</h4>
                            <p class="text-xs text-gray-600 mt-0.5 leading-relaxed">Ingredientes, gramos y preparación estandarizada.</p>
                        </div>
                    </a>

                    <a href="{{ route('recetas.elaboradas.index') }}" class="p-4.5 rounded-2xl bg-white border border-gray-200/80 hover:border-emerald-300 hover:shadow-xs transition-all group flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-xl group-hover:scale-105 transition-transform shrink-0">
                            <i class="ri-scales-3-line"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 group-hover:text-teal-800 transition-colors">Cálculos con Merma</h4>
                            <p class="text-xs text-gray-600 mt-0.5 leading-relaxed">Revisar historial de costos y márgenes de venta.</p>
                        </div>
                    </a>
                </div>

                {{-- Interactive Live Yield / Merma Calculator inside Dashboard --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs" x-data="{
                    costoBruto: 280,
                    mermaPorcentaje: 15,
                    gramosPorcion: 200,
                    margenDeseado: 65,
                    get costoNetoKg() {
                        let rendimiento = (100 - this.mermaPorcentaje) / 100;
                        return rendimiento > 0 ? (this.costoBruto / rendimiento) : 0;
                    },
                    get costoPorcion() {
                        return (this.costoNetoKg * (this.gramosPorcion / 1000));
                    },
                    get precioVenta() {
                        let factorMargen = (100 - this.margenDeseado) / 100;
                        return factorMargen > 0 ? (this.costoPorcion / factorMargen) : 0;
                    }
                }">
                    <div class="flex items-center gap-2.5 mb-4 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                            <i class="ri-calculator-line"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">Calculadora Rápida de Merma & Costeo</h3>
                            <p class="text-[11px] text-gray-500 font-medium">Prueba el impacto del porcentaje de merma en tu precio de venta</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 items-center">
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                    <span>Costo Bruto Insumo ($/Kg):</span>
                                    <span class="text-emerald-700" x-text="'$' + costoBruto + ' /kg'"></span>
                                </div>
                                <input type="range" min="40" max="600" step="10" x-model="costoBruto" class="w-full accent-emerald-600 cursor-pointer">
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                    <span>Merma por Limpieza (%):</span>
                                    <span class="text-emerald-700" x-text="mermaPorcentaje + '%'"></span>
                                </div>
                                <input type="range" min="0" max="40" step="1" x-model="mermaPorcentaje" class="w-full accent-emerald-600 cursor-pointer">
                            </div>

                            <div>
                                <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                    <span>Porción Servida (g):</span>
                                    <span class="text-emerald-700" x-text="gramosPorcion + ' g'"></span>
                                </div>
                                <input type="range" min="50" max="400" step="10" x-model="gramosPorcion" class="w-full accent-emerald-600 cursor-pointer">
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-emerald-50/80 border border-emerald-200 space-y-2 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-medium">Costo Neto Real/Kg:</span>
                                <span class="font-bold text-gray-900" x-text="'$' + costoNetoKg.toFixed(2) + ' /kg'"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-medium">Costo de Porción:</span>
                                <span class="font-black text-emerald-800 text-sm" x-text="'$' + costoPorcion.toFixed(2)"></span>
                            </div>
                            <div class="pt-2 border-t border-emerald-200 flex justify-between items-center">
                                <div>
                                    <span class="font-bold text-emerald-950 block">Precio Sugerido:</span>
                                    <span class="text-[10px] text-gray-500 font-medium">(Margen 65%)</span>
                                </div>
                                <span class="text-lg font-black text-emerald-700" x-text="'$' + precioVenta.toFixed(2)"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column: Guidance & Profile Summary --}}
            <div class="space-y-5">
                
                {{-- Educational Tip Card --}}
                <div class="bg-emerald-50/80 border border-emerald-200/80 rounded-2xl p-5 text-emerald-950">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-sm">
                            <i class="ri-lightbulb-line"></i>
                        </div>
                        <h3 class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Cálculo de Mermas</h3>
                    </div>

                    <p class="text-xs text-emerald-800 leading-relaxed mb-3 font-medium">
                        El <strong>factor de merma</strong> descuenta los residuos de limpieza (cáscaras, grasa, huesos) para darte el costo real por gramo útil.
                    </p>

                    <div class="space-y-2 bg-white/90 p-3 rounded-xl border border-emerald-200/70 text-[11px]">
                        <div class="flex justify-between py-0.5">
                            <span class="text-gray-600">Costo Neto:</span>
                            <span class="font-bold text-emerald-900">Costo Bruto ÷ Rendimiento</span>
                        </div>
                        <div class="flex justify-between py-0.5 border-t border-emerald-100">
                            <span class="text-gray-600">Costo Porción:</span>
                            <span class="font-bold text-emerald-900">Costo Total ÷ Porciones</span>
                        </div>
                    </div>

                    <a href="{{ route('recetas') }}" class="mt-3.5 block w-full py-2 px-3 rounded-xl text-xs font-bold text-center bg-emerald-600 hover:bg-emerald-700 text-white transition-colors">
                        Costear en Catálogo
                    </a>
                </div>

                {{-- User Profile Quick Summary --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 p-5 shadow-xs">
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <div class="w-7 h-7 rounded-lg bg-gray-100 text-gray-700 flex items-center justify-center text-sm">
                            <i class="ri-user-line"></i>
                        </div>
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Mi Ficha Culinaria</h3>
                    </div>

                    <div class="space-y-2.5 text-xs font-medium">
                        <div class="flex justify-between py-1 border-b border-gray-100">
                            <span class="text-gray-500">Usuario</span>
                            <span class="font-bold text-gray-900">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-gray-100">
                            <span class="text-gray-500">Institución</span>
                            <span class="font-semibold text-gray-900">{{ Auth::user()->institution ?? 'No asignada' }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-gray-500">Rol</span>
                            <span class="font-bold text-emerald-700 capitalize">{{ Auth::user()->rol ?? 'Estudiante' }}</span>
                        </div>
                    </div>

                    <a href="{{ route('profile.user') }}" class="mt-3.5 block w-full py-2 px-3 text-center rounded-xl text-xs font-bold text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200/60 transition-colors">
                        Ver Perfil Completo
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
