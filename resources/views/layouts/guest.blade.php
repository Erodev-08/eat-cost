<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Eat-Cost | Costeo Culinario') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 dark:text-slate-100 antialiased bg-gray-50 dark:bg-slate-900 transition-colors duration-200">
        <div class="fixed top-4 right-4 z-50">
            <x-theme-toggle />
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
            <div class="mb-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-md">
                        <i class="ri-restaurant-line text-xl"></i>
                    </div>
                    <div class="text-xl font-bold tracking-tight text-gray-900">
                        <span class="text-emerald-700 font-black">Eat</span><span class="text-gray-300 font-light mx-0.5">•</span><span class="text-emerald-500 font-semibold">Cost</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white border border-gray-200 shadow-xl overflow-hidden rounded-3xl p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
