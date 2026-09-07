@extends('layouts.plantilla')

@section('title', 'Términos del Servicio - Eat-Cost')

@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Encabezado --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 mb-4 shadow-xs">
                <i class="ri-file-text-line text-2xl"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Términos del Servicio
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
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Aceptación y Propósito de la Plataforma</h2>
                        <p>
                            Al acceder y utilizar <strong class="text-gray-900">Eat-Cost</strong>, aceptas hacer un uso responsable y ético de la plataforma y de las herramientas puestas a tu disposición. Nuestro principal objetivo es brindar una solución intuitiva para el costeo culinario, cálculo de mermas y gestión financiera para profesionales, estudiantes y entusiastas del sector gastronómico.
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
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Uso Responsable de la Información</h2>
                        <p>
                            Garantizamos que no se hará ningún uso malintencionado de los datos, recetas ni costos registrados por los usuarios. Eat-Cost no comercializa, transfiere ni expone información confidencial o de propiedad intelectual de tus recetas a terceros.
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
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Protección de Datos y Privacidad</h2>
                        <p>
                            Reconocemos y respetamos el derecho a la privacidad de tu información personal y financiera. Actuamos en total conformidad con las normativas y buenas prácticas aplicables para la protección de datos personales.
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
                        <h2 class="text-lg font-bold text-gray-900 mb-2">Modificaciones y Conformidad</h2>
                        <p>
                            Nos reservamos el derecho de actualizar estos términos para reflejar mejoras en nuestros servicios. Si en algún momento no estás de acuerdo con los términos estipulados, puedes abstenerte del uso de la plataforma o cancelar tu cuenta en cualquier momento.
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
                    <a href="{{ route('privacy.show') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors">
                        Ver Política de Privacidad
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
