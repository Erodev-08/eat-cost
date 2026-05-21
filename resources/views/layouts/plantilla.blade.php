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
</body>
</html>
