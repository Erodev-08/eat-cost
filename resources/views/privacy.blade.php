@extends('layouts.plantilla')

@section('title', 'Política de Privacidad - Eat-Cost')

@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Encabezado --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 mb-4 shadow-xs">
                <i class="ri-shield-check-line text-2xl"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Política de Privacidad
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Última actualización: {{ date('d \d\e F, Y') }}
            </p>
            <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>
        </div>

        {{-- Contenedor Principal --}}
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-6 sm:p-10 mb-8">
            
            <div class="space-y-8 text-gray-600 text-sm sm:text-base leading-relaxed">
                
                {{-- Sección 1 --}}
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0 mt-0.5 border border-emerald-100">
                        1
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Recopilación y Uso de la Información</h2>
                        <p>
                            La información proporcionada por los usuarios (como nombre, correo electrónico, recetas, ingredientes y costos) se utiliza exclusivamente para el correcto funcionamiento de las herramientas de <strong class="text-gray-900">Eat-Cost</strong> y para optimizar tu experiencia en la gestión de costos culinarios.
                        </p>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- Sección 2 --}}
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0 mt-0.5 border border-emerald-100">
                        2
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Seguridad y Confidencialidad</h2>
                        <p>
                            Garantizamos un manejo riguroso y transparente de tu información. Este sitio no vende, alquila, transfiere ni distribuye datos personales o recetas de usuarios a terceras partes bajo ninguna circunstancia sin tu consentimiento expreso.
                        </p>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- Sección 3 --}}
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0 mt-0.5 border border-emerald-100">
                        3
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Derechos del Usuario</h2>
                        <p>
                            Tienes pleno derecho a acceder, rectificar, actualizar o eliminar la información de tu perfil y tus recetas en cualquier momento directamente desde tu panel de usuario o configuración de cuenta.
                        </p>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- Sección 4 --}}
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0 mt-0.5 border border-emerald-100">
                        4
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Almacenamiento y Protección de Datos</h2>
                        <p>
                            Implementamos medidas de seguridad técnicas y organizativas para proteger tus datos contra accesos no autorizados, pérdidas o alteraciones, salvaguardando la integridad de tus cálculos y registros financieros.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Pie con Botones de Navegación --}}
            <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-2xs">
                    <i class="ri-arrow-left-line"></i>
                    Regresar
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('terms.show') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors">
                        Ver Términos del Servicio
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
