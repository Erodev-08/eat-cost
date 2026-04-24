<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-400 via-orange-300 to-green-400 flex-col justify-between p-12 text-white">
                <div>
                    <div class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">CulinFinance</span>
                    </div>
                    
                    <h1 class="text-5xl font-bold mb-6 leading-tight">Domina tus finanzas, cocina tu éxito</h1>
                    <p class="text-lg text-white text-opacity-90 mb-12 leading-relaxed">La plataforma educativa diseñada para estudiantes de artes culinarias que quieren fortalecer sus competencias financieras.</p>
                    
                    <!-- Features -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white bg-opacity-20 backdrop-blur rounded-lg p-6">
                            <div class="text-3xl mb-3">📈</div>
                            <h3 class="text-xl font-bold mb-2">Aprende finanzas</h3>
                            <p class="text-white text-opacity-90 text-sm">Conceptos aplicados al mundo culinario</p>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur rounded-lg p-6">
                            <div class="text-3xl mb-3">📊</div>
                            <h3 class="text-xl font-bold mb-2">Herramientas prácticas</h3>
                            <p class="text-white text-opacity-90 text-sm">Cálculo costos, márgenes y presupuestos</p>
                        </div>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div class="text-white text-opacity-20">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                    </svg>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
