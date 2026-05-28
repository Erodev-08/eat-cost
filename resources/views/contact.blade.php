@extends('layouts.plantilla')

@section('title', 'Contacto')

@section('content')
    <div class="container mx-auto px-4 mt-16">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h1 class="text-3xl font-bold text-blue-900 mb-2">Contacto</h1>
            <p class="text-gray-600 mb-6">Si tienes dudas o sugerencias, escribenos.</p>

            <div class="space-y-4">
                <div>
                    <div class="text-sm font-semibold text-gray-700">Correo</div>
                    <a class="text-blue-700 hover:text-blue-800" href="mailto:contacto@culinfinance.test">
                        contacto@culinfinance.test
                    </a>
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-700">Horario</div>
                    <div class="text-gray-600">Lunes a viernes, 9:00 a 18:00</div>
                </div>
            </div>
        </div>
    </div>
@endsection
