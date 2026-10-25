@extends('layouts.plantilla')

@section('title', 'Eat-Cost | Costeo Culinario e Ingeniería de Menú')

@section('content')

    {{-- Toast Notification --}}
    @if (Session::has('success'))
        <div id="alertOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-xs transition-opacity duration-300">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 border border-gray-200 p-6 transform transition-all duration-300 scale-100">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shrink-0">
                        <i class="ri-checkbox-circle-fill"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-900">
                            @if(Session::get('success') == 'success-user')
                                ¡Sesión Iniciada!
                            @elseif(Session::get('success') == 'success-logout')
                                Sesión Finalizada
                            @else
                                {{ Session::get('success') }}
                            @endif
                        </h3>
                        <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                            @php
                                $status = Session::get('success');
                                $message = match($status) {
                                    'success-user' => 'Has iniciado sesión correctamente en Eat-Cost.',
                                    'success-logout' => 'Tu sesión ha sido cerrada correctamente.',
                                    default => $status
                                };
                            @endphp
                            {{ $message }}
                        </p>
                    </div>
                    <button onclick="closeAlert()" class="text-gray-400 hover:text-gray-700 p-1">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>
                <div class="mt-5 flex justify-end">
                    <button onclick="closeAlert()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-colors">
                        Entendido
                    </button>
                </div>
            </div>
        </div>

        <script>
            function closeAlert() {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay) {
                    alertOverlay.style.opacity = '0';
                    setTimeout(() => alertOverlay.remove(), 250);
                }
            }
            document.addEventListener('click', function(e) {
                const alertOverlay = document.getElementById('alertOverlay');
                if (alertOverlay && e.target === alertOverlay) closeAlert();
            });
        </script>
    @endif

    {{-- Main Landing Content --}}
    <div class="space-y-16 sm:space-y-24 pb-16">
        
        {{-- ========================================================================= --}}
        {{-- 1. HERO SECTION --}}
        {{-- ========================================================================= --}}
        <section class="relative pt-6 sm:pt-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                {{-- Left Column: Value Proposition & CTAs --}}
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200/80 text-xs font-bold shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Plataforma Gastronómica de Costeo & Rendimiento</span>
                    </div>

                    {{-- Main Headline --}}
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight leading-[1.15]">
                        Domina el <span class="text-emerald-700">costeo de tus recetas</span> y protege la rentabilidad de tu cocina.
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Calcula mermas reales, costos unitarios por porción y precios de venta sugeridos en segundos. Diseñado para chefs, pasteleros, estudiantes de gastronomía y restaurantes.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition-all transform hover:-translate-y-0.5">
                                <i class="ri-dashboard-3-line text-lg"></i>
                                <span>Ir a Mi Dashboard</span>
                            </a>
                            <a href="{{ route('recetas') }}" class="inline-flex items-center gap-2 px-5 py-3.5 rounded-xl bg-white hover:bg-gray-50 text-gray-800 font-bold text-sm border border-gray-200/80 shadow-xs transition-colors">
                                <i class="ri-book-open-line text-emerald-600 text-lg"></i>
                                <span>Mis Recetas</span>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition-all transform hover:-translate-y-0.5">
                                <i class="ri-user-add-line text-lg"></i>
                                <span>Comenzar Gratis</span>
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-3.5 rounded-xl bg-white hover:bg-gray-50 text-gray-800 font-bold text-sm border border-gray-200/80 shadow-xs transition-colors">
                                <i class="ri-login-box-line text-emerald-600 text-lg"></i>
                                <span>Iniciar Sesión</span>
                            </a>
                        @endauth
                    </div>

                    {{-- Trust Checkpoints --}}
                    <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-5 text-xs text-gray-600 font-semibold">
                        <span class="inline-flex items-center gap-1.5">
                            <i class="ri-checkbox-circle-fill text-emerald-600 text-base"></i>
                            Cálculo de mermas (%)
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i class="ri-checkbox-circle-fill text-emerald-600 text-base"></i>
                            Fichas de costo por porción
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <i class="ri-checkbox-circle-fill text-emerald-600 text-base"></i>
                            Márgenes y precio sugerido
                        </span>
                    </div>

                </div>

                {{-- Right Column: Live Recipe Costing Mockup Card --}}
                <div class="lg:col-span-5">
                    <div class="relative">
                        
                        {{-- Background Soft Glow --}}
                        <div class="absolute -inset-2 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-3xl blur-lg opacity-70"></div>
                        
                        {{-- Mockup Card --}}
                        <div class="relative bg-white rounded-3xl border border-gray-200/90 shadow-xl p-6 sm:p-7 space-y-5">
                            
                            {{-- Header of Mockup --}}
                            <div class="flex items-center justify-between pb-3.5 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold border border-emerald-100">
                                        <i class="ri-restaurant-2-fill"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-900">Salmón al Romero & Cítricos</h3>
                                        <p class="text-[11px] text-gray-500 font-medium">Ficha Técnica • 4 Porciones</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    Rentable
                                </span>
                            </div>

                            {{-- Ingredient Lines with Yield/Merma --}}
                            <div class="space-y-2.5 text-xs">
                                <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                                    <div>
                                        <p class="font-bold text-gray-800">Lomo de Salmón Fresco</p>
                                        <p class="text-[10px] text-gray-500">800g • Merma: 12%</p>
                                    </div>
                                    <span class="font-bold text-gray-900">$215.00</span>
                                </div>

                                <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                                    <div>
                                        <p class="font-bold text-gray-800">Mantequilla de Finas Hierbas</p>
                                        <p class="text-[10px] text-gray-500">120g • Merma: 0%</p>
                                    </div>
                                    <span class="font-bold text-gray-900">$38.50</span>
                                </div>

                                <div class="flex items-center justify-between p-2.5 rounded-xl bg-gray-50 border border-gray-100">
                                    <div>
                                        <p class="font-bold text-gray-800">Espárragos & Limón Eureka</p>
                                        <p class="text-[10px] text-gray-500">300g • Merma: 18%</p>
                                    </div>
                                    <span class="font-bold text-gray-900">$42.00</span>
                                </div>
                            </div>

                            {{-- Summary Metrics Box --}}
                            <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 space-y-2">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-600 font-medium">Costo Total de Receta:</span>
                                    <span class="font-bold text-gray-900">$295.50 MXN</span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-600 font-medium">Costo por Porción (x4):</span>
                                    <span class="font-black text-emerald-800 text-sm">$73.88 MXN</span>
                                </div>
                                <div class="pt-2 border-t border-emerald-200/60 flex justify-between items-center text-xs">
                                    <div>
                                        <span class="text-emerald-900 font-bold block">Precio Sugerido (65% Margen):</span>
                                        <span class="text-[10px] text-gray-500 font-medium">Con factor de costo objetivo</span>
                                    </div>
                                    <span class="text-base font-black text-emerald-700">$211.00</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- ========================================================================= --}}
        {{-- 2. PILLARES / CARACTERÍSTICAS PRINCIPALES --}}
        {{-- ========================================================================= --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-700 mb-1">
                    Funcionalidades Creadas para la Cocina
                </h2>
                <h3 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                    Todo lo que necesitas para costear profesionalmente
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                
                {{-- Feature 1 --}}
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-xs hover:border-emerald-300 hover:shadow-sm transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-105 transition-transform border border-emerald-100">
                        <i class="ri-file-list-3-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1.5">Fichas Estandarizadas</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Registra ingredientes, unidades de medida (kg, g, ml, pza) y porciones para mantener la consistencia de tu menú.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-xs hover:border-emerald-300 hover:shadow-sm transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-105 transition-transform border border-teal-100">
                        <i class="ri-scales-3-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1.5">Control de Mermas</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Aplica el factor de merma real por limpieza o cocción para conocer el costo neto auténtico de cada ingrediente.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-xs hover:border-emerald-300 hover:shadow-sm transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-105 transition-transform border border-green-100">
                        <i class="ri-calculator-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1.5">Costo por Porción</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Divide el costo total entre el rendimiento de porciones para saber exactamente cuánto cuesta servir cada plato.
                    </p>
                </div>

                {{-- Feature 4 --}}
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-xs hover:border-emerald-300 hover:shadow-sm transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-105 transition-transform border border-emerald-100">
                        <i class="ri-price-tag-3-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1.5">Precio Sugerido</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Fija tu margen de utilidad deseado (ej. 60%, 70%) y obtén el precio de venta recomendado automáticamente.
                    </p>
                </div>

            </div>
        </section>

        {{-- ========================================================================= --}}
        {{-- 3. CÓMO FUNCIONA EAT-COST (3 PASOS CLAROS) --}}
        {{-- ========================================================================= --}}
        <section class="bg-emerald-50/50 py-12 border-y border-emerald-100/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-xl mx-auto mb-10">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-emerald-700 mb-1">
                        Flujo de Trabajo
                    </h2>
                    <h3 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                        Costea cualquier receta en 3 sencillos pasos
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                    
                    {{-- Step 1 --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-xs text-center space-y-3 relative">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-bold text-sm flex items-center justify-center mx-auto shadow-sm">
                            1
                        </div>
                        <h4 class="text-sm font-bold text-gray-900">Registra tus Insumos</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Ingresa tus ingredientes con su costo de compra por kilo, litro o pieza.
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-xs text-center space-y-3 relative">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-bold text-sm flex items-center justify-center mx-auto shadow-sm">
                            2
                        </div>
                        <h4 class="text-sm font-bold text-gray-900">Diseña tu Receta & Merma</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Agrega los ingredientes a la receta indicando gramos exactos y el % de merma aplicada.
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-xs text-center space-y-3 relative">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-bold text-sm flex items-center justify-center mx-auto shadow-sm">
                            3
                        </div>
                        <h4 class="text-sm font-bold text-gray-900">Obtén tu Ficha de Costo</h4>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Visualiza el costo total, costo unitario por porción y precio de venta recomendado.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        {{-- ========================================================================= --}}
        {{-- 4. MINI SIMULADOR INTERACTIVO DE MERMA Y COSTEO --}}
        {{-- ========================================================================= --}}
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm">
                
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold border border-emerald-100">
                        <i class="ri-flask-line"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Simulador de Impacto de Merma</h3>
                        <p class="text-xs text-gray-500">Prueba cómo la merma cambia el costo real de tu materia prima</p>
                    </div>
                </div>

                {{-- Interactive Widget --}}
                <div x-data="{
                    costoBruto: 320,
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
                }" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    
                    {{-- Controls --}}
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                <span>Costo de Compra por Kg ($):</span>
                                <span class="text-emerald-700" x-text="'$' + costoBruto + ' /kg'"></span>
                            </div>
                            <input type="range" min="50" max="800" step="10" x-model="costoBruto" class="w-full accent-emerald-600 cursor-pointer">
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                <span>Merma Estimada (%):</span>
                                <span class="text-emerald-700" x-text="mermaPorcentaje + '%'"></span>
                            </div>
                            <input type="range" min="0" max="50" step="1" x-model="mermaPorcentaje" class="w-full accent-emerald-600 cursor-pointer">
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                <span>Gramos por Porción (g):</span>
                                <span class="text-emerald-700" x-text="gramosPorcion + ' g'"></span>
                            </div>
                            <input type="range" min="50" max="500" step="10" x-model="gramosPorcion" class="w-full accent-emerald-600 cursor-pointer">
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold text-gray-700 mb-1">
                                <span>Margen de Ganancia Objetivo (%):</span>
                                <span class="text-emerald-700" x-text="margenDeseado + '%'"></span>
                            </div>
                            <input type="range" min="30" max="85" step="5" x-model="margenDeseado" class="w-full accent-emerald-600 cursor-pointer">
                        </div>
                    </div>

                    {{-- Live Calculation Display --}}
                    <div class="p-5 rounded-2xl bg-emerald-50/80 border border-emerald-200 space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-600 font-medium">Costo Neto Real por Kg:</span>
                            <span class="font-bold text-gray-900" x-text="'$' + costoNetoKg.toFixed(2) + ' /kg'"></span>
                        </div>

                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-600 font-medium">Costo Real por Porción:</span>
                            <span class="font-black text-emerald-800 text-sm" x-text="'$' + costoPorcion.toFixed(2)"></span>
                        </div>

                        <div class="pt-3 border-t border-emerald-200/80 flex justify-between items-center">
                            <div>
                                <span class="text-xs font-bold text-emerald-950 block">Precio de Venta Sugerido:</span>
                                <span class="text-[10px] text-gray-500">Para asegurar tu margen</span>
                            </div>
                            <span class="text-xl font-black text-emerald-700" x-text="'$' + precioVenta.toFixed(2)"></span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        {{-- ========================================================================= --}}
        {{-- 5. FINAL CTA BANNER --}}
        {{-- ========================================================================= --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-800 text-white p-8 sm:p-12 text-center relative overflow-hidden shadow-lg">
                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <h3 class="text-2xl sm:text-3xl font-black tracking-tight leading-tight">
                        ¿Listo para hacer rentable cada platillo de tu menú?
                    </h3>
                    <p class="text-xs sm:text-sm text-emerald-100 leading-relaxed">
                        Únete a Eat-Cost y comienza a costear con precisión matemática, controlando mermas y maximizando el beneficio de tu cocina.
                    </p>
                    <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-white text-emerald-800 font-bold text-xs shadow-md hover:bg-emerald-50 transition-colors">
                                Acceder a Mi Panel
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-white text-emerald-800 font-bold text-xs shadow-md hover:bg-emerald-50 transition-colors">
                                Crear Cuenta Gratis
                            </a>
                            <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-emerald-800/80 text-white font-bold text-xs border border-white/20 hover:bg-emerald-800 transition-colors">
                                Ya tengo cuenta
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
