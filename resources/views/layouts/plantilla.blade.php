<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>@yield('title', 'Mi Aplicación Laravel')</title> --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Estilos adicionales por sección --}}
    @stack('styles')

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-50">
    {{-- Header --}}
    @include('layouts.partials.header')
    
    {{-- Contenido principal --}}
    <div id="app" class="min-h-screen">
        <main class="py-4 mt-16">
            @yield('content')
            {{-- {{ $slot }} --}}
        </main>
    </div>
    
    {{-- Footer --}}
    @include('layouts.partials.footer')
    
    {{-- Scripts adicionales por sección --}}
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let status = "{{ session('status') }}";

                let title = 'Operación realizada';
                let text = 'La acción se completó correctamente.';
                let icon = 'success';

                if (status === 'success-receta') {
                    title = 'Receta creada';
                    text = 'La receta se guardó correctamente.';
                }

                if (status === 'success-receta-update') {
                    title = 'Receta actualizada';
                    text = 'Los cambios se guardaron correctamente.';
                }

                if (status === 'success-receta-delete') {
                    title = 'Receta eliminada';
                    text = 'La receta se eliminó correctamente.';
                }

                if (status === 'success-calculo') {
                    title = 'Cálculo generado';
                    text = 'El cálculo de la receta se realizó correctamente.';
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#2563eb',
                    timer: 2500,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
