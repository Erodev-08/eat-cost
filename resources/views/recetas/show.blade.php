@extends('layouts.plantilla')

@section('title', 'Show Recetas')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:flex items-center justify-between">
                <div class="mb-3 md:mb-8 p-5">
                    <h1 class="text-4xl font-bold text-blue-900 mb-3 mt-3">Receta: {{ $receta->nombre_receta }}</h1> {{-- {{ $receta->name }} --}}
                    <a href="{{ route('recetas') }}" class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-gray-100 rounded-lg md:py-2 md:px-3 mb-3 mt-5 px-3 py-3">Volver</a>
                </div>
                <div class="mb-3 md:mb-8 p-5">
                    <a href="#" class="bg-blue-700 text-gray-100 hover:bg-blue-900 hover:text-gray-200 rounded-lg md:py-3 md:px-3 mb-2 mt-2 px-2 py-3">Genera reporte</a>
                </div>
            </div>
            <hr class="mb-5">
        </div>
    </div>

    <div class="px-5 py-3 md:px-6 md:py-4">
        <div class="max-w-7xl md:max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 p-6 md:p-5 ">
            <div class="mb-8">
                @php
                    $suma = 0;
                @endphp
                <h3 class="text-2xl font-bold text-gray-600 mb-3 mt-3">Ingrendientes:</h3>
                @if ($receta->ingredientes->count())
                    <ul class="list-disc list-inside space-y-2 text-lg text-gray-700">
                        @foreach ($receta->ingredientes as $ingrediente)
                            <li>
                                {{ $ingrediente->nombre }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No hay ingredientes registrados</p>
                @endif
            </div>
            <div class="mb-8 w-full border-collapse border border-gray-400">
                <h3 class="text-xl font-bold text-gray-100 mb-3 p-3 bg-gray-600">Procedimiento:</h3>
                <p class="text-lg text-gray-700 mb-3 mt-2 p-3">{{ $receta->procedimiento }}</p>
            </div>
            <div class="mb-8 w-full border-collapse border border-gray-400">
                <h3 class="text-2xl font-bold text-gray-100 mb-3 p-3 bg-gray-600">Descripcion:</h3>
                <p class="text-lg text-gray-700 mb-3 mt-2 p-3">{{ $receta->descripcion }}</p> {{-- {{ $receta->descripcion }} --}}
            </div>
            <div class="mb-8">
                <img 
                {{-- src="https://th.bing.com/th/id/OIP.tzsc10a70pK9ITW5OVR5kgHaD5?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3"  --}}
                src="{{ asset('storage/' . $receta->imagen) }}"
                alt="imagen receta"
                class="w-full rounded-lg" style="height: 30rem">
            </div>
        </div>
    </div>
@endsection
