<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800 h-full flex flex-col">
        
        <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">
            
            {{-- Mobile Backdrop --}}
            <div 
                x-show="sidebarOpen" 
                x-transition:enter="transition-opacity ease-linear duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="sidebarOpen = false" 
                class="fixed inset-0 bg-gray-900/50 backdrop-blur-xs z-40 lg:hidden"
                style="display: none;">
            </div>

            {{-- Clean White & Green Sidebar --}}
            <aside 
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                class="fixed top-0 bottom-0 left-0 z-50 w-64 bg-white border-r border-gray-200 text-gray-700 flex flex-col justify-between transition-transform duration-200 ease-in-out shadow-xs">
                
                {{-- Brand Logo --}}
                <div class="p-5 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                            {{-- Fresh Culinary Leaf / Chef Badge --}}
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-md shadow-emerald-600/20 group-hover:bg-emerald-700 transition-colors">
                                <i class="ri-restaurant-line text-xl"></i>
                            </div>
                            <div>
                                <div class="text-xl font-bold text-gray-900 tracking-tight flex items-center">
                                    <span class="text-emerald-700 font-extrabold">Eat</span>
                                    <span class="text-gray-300 mx-0.5 font-light">•</span>
                                    <span class="text-emerald-500 font-semibold">Cost</span>
                                </div>
                                <p class="text-[10px] font-medium text-emerald-600">Costeo Gastronómico</p>
                            </div>
                        </a>
                        
                        {{-- Close button on mobile --}}
                        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-700 p-1">
                            <i class="ri-close-line text-xl"></i>
                        </button>
                    </div>
                </div>

                {{-- Navigation Links --}}
                <div class="flex-1 overflow-y-auto px-3 py-4 space-y-5">
                    
                    {{-- PLATAFORMA --}}
                    <div>
                        <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">
                            Menú Principal
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-home-5-line text-lg {{ request()->routeIs('dashboard') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Inicio</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- COCINA & COSTOS --}}
                    <div>
                        <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">
                            Recetas & Costeo
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('recetas') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('recetas') && !request()->routeIs('recetas.create') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-book-read-line text-lg {{ request()->routeIs('recetas') && !request()->routeIs('recetas.create') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Mis Recetas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('recetas.create') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('recetas.create') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-add-circle-line text-lg {{ request()->routeIs('recetas.create') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Nueva Receta</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('recetas.elaboradas.index') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('recetas.elaboradas.*') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-scales-3-line text-lg {{ request()->routeIs('recetas.elaboradas.*') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Costeo & Mermas</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- CUENTA --}}
                    <div>
                        <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">
                            Cuenta
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('profile.user') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('profile.user') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-user-line text-lg {{ request()->routeIs('profile.user') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Perfil de Usuario</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.configuracion') }}" 
                                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('profile.configuracion') ? 'bg-emerald-50 text-emerald-700 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <i class="ri-settings-3-line text-lg {{ request()->routeIs('profile.configuracion') ? 'text-emerald-600 font-bold' : 'text-gray-400' }}"></i>
                                    <span>Configuración</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- User Profile Card at Bottom --}}
                <div class="p-3 border-t border-gray-100 bg-gray-50/50">
                    @auth
                        @php
                            $userAvatar = Auth::user()->avatar_url;
                            $userRole = ucfirst(Auth::user()->rol ?? 'Estudiante');
                        @endphp
                        
                        <div class="bg-white rounded-xl p-2.5 border border-gray-200/80 shadow-xs flex items-center justify-between gap-2.5">
                            <a href="{{ route('profile.user') }}" class="flex items-center gap-2.5 min-w-0 group flex-1">
                                <img class="w-9 h-9 rounded-lg object-cover ring-1 ring-emerald-200" src="{{ $userAvatar }}" alt="{{ Auth::user()->name }}">
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-800 truncate group-hover:text-emerald-700 transition-colors">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-[11px] font-medium text-emerald-600 truncate">
                                        {{ $userRole }}
                                    </p>
                                </div>
                            </a>

                            {{-- Logout Button --}}
                            <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                                @csrf
                                <button 
                                    type="submit" 
                                    title="Cerrar Sesión" 
                                    class="w-7 h-7 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-colors">
                                    <i class="ri-logout-box-r-line text-sm"></i>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

            </aside>

            {{-- Main Layout Content Area --}}
            <div class="flex-1 flex flex-col lg:pl-64 min-w-0">
                
                {{-- Top Navigation Bar --}}
                <header class="bg-white sticky top-0 z-30 border-b border-gray-200 px-4 sm:px-6 py-3 flex items-center justify-between shadow-xs">
                    
                    {{-- Mobile menu button --}}
                    <div class="flex items-center gap-3">
                        <button 
                            @click="sidebarOpen = true" 
                            type="button" 
                            class="lg:hidden p-1.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
                            aria-label="Abrir menú">
                            <i class="ri-menu-line text-xl"></i>
                        </button>
                        
                        <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Eat-Cost Cocina & Finanzas</span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2.5">
                        <a href="{{ route('recetas.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white shadow-xs transition-colors">
                            <i class="ri-add-line"></i>
                            <span>Nueva Receta</span>
                        </a>

                        <a href="{{ route('recetas.elaboradas.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition-colors">
                            <i class="ri-scales-3-line"></i>
                            <span>Calculadora</span>
                        </a>

                        <div class="h-4 w-px bg-gray-200 mx-1 hidden sm:block"></div>

                        @auth
                            <a href="{{ route('profile.user') }}" class="flex items-center gap-2 text-xs font-medium text-gray-700 hover:text-emerald-700 transition-colors">
                                <img class="w-7 h-7 rounded-lg object-cover ring-1 ring-emerald-200" src="{{ $userAvatar }}" alt="Avatar">
                                <span class="hidden md:inline font-semibold">{{ Auth::user()->name }}</span>
                            </a>
                        @endauth
                    </div>
                </header>

                {{-- Page Main Content --}}
                <main class="flex-1">
                    {{ $slot }}
                </main>

                {{-- Footer --}}
                <footer class="py-4 px-6 text-center text-xs text-gray-400 bg-white border-t border-gray-100">
                    <p>© {{ date('Y') }} <strong>Eat-Cost</strong> • Costeo Culinario y Rendimiento de Alimentos.</p>
                </footer>

            </div>

        </div>

    </body>
</html>
