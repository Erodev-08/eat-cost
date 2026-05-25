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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- start: Sidebar --}}
            <div class="fixed justify-between left-0 top-auto w-64 h-full bg-orange-500 p-4 flex flex-col">
                <a href="{{ route('home') }}" class="flex items-center pb-4 border-b border-b-gray-100">
                   <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm ring-1 ring-white/20">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M7 20h10a2 2 0 0 0 2-2v-4H5v4a2 2 0 0 0 2 2Z" />
                            <path d="M7 14c0-2 1.5-3.5 3.5-3.5h3c2 0 3.5 1.5 3.5 3.5" />
                            <path d="M8 10.5c0-2 1.2-3.7 3-4.5" />
                            <path d="M16 10.5c0-2-1.2-3.7-3-4.5" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-200 ml-3">CulinFinance</span>
                </a>
                <ul class="mt-4">
                    <li class="mb-2 group active">
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 text-gray-300 {{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white' : 'hover:bg-orange-400 hover:text-gray-100' }} rounded-md">
                            <i class="ri-home-line mr-3 text-lg"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-2 group">
                        <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-400 hover:text-gray-100 rounded-md sidebar-dropdown-toggle">
                            <i class="ri-user-line mr-3 text-lg"></i>
                            <span class="text-sm">Users</span>
                            <i class="ri-arrow-right-s-line ml-auto transition-transform duration-200 sidebar-dropdown-icon"></i>
                        </a>
                        <ul class="pl-7 mt-2 hidden sidebar-dropdown-menu">
                            <li class="mb-3">
                                <a href="{{ route('profile.user') }}" class="py-2 px-4 text-gray-300 text-sm flex items-center {{ request()->routeIs('profile.user') ? 'bg-orange-600' : 'hover:bg-orange-400' }} rounded-md transition-colors duration-200">
                                    <i class="ri-user-fill mr-3 text-lg"></i>
                                    Profile
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="{{ route('profile.edit') }}" class="py-2 px-4 text-gray-300 text-sm flex items-center {{ request()->routeIs('profile.edit') ? 'bg-orange-600' : 'hover:bg-orange-400' }} rounded-md transition-colors duration-200">
                                    <i class="ri-file-edit-fill mr-3 text-lg"></i>
                                    Edit Profile
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Logout en la parte inferior -->
                <div class="mt-auto pt-4 border-t border-gray-100 group">
                    <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-400 hover:text-gray-100 rounded-md sidebar-dropdown-toggle">
                        <!-- Avatar Placeholder -->
                        <div class="relative">
                            @auth
                                @php
                                    // Obtener la imagen de perfil del usuario autenticado
                                    $profileImage = Auth::user()->profile && Auth::user()->profile->profile 
                                        ? Storage::url(Auth::user()->profile->profile) 
                                        : 'https://ui-avatars.com/api/?background=3b82f6&color=fff&name=' . urlencode(Auth::user()->name);
                                @endphp
                                <img class="w-12 h-12 rounded-full object-cover" src="{{ $profileImage }}" alt="Profile">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center">
                                    <i class="ri-user-line text-white text-xl"></i>
                                </div>
                            @endauth
                        </div>
                        @auth
                            <span class="text-sm font-bold text-gray-200 ml-3">{{ Auth::user()->name }}</span>
                        @else
                            <span class="text-sm font-bold text-gray-200 ml-3">Guest</span>
                        @endauth
                        <i class="ri-arrow-right-s-line ml-auto transition-transform duration-200 sidebar-dropdown-icon"></i>
                    </a>
                    <ul class="pl-7 mt-2 hidden sidebar-dropdown-menu">
                        <li class="mb-3">
                            <a href="{{ route('profile.configuracion') }}" class="py-2 px-4 text-gray-300 text-sm flex items-center {{ request()->routeIs('profile.configuracion') ? 'bg-orange-600' : 'hover:bg-orange-400' }} rounded-md transition-colors duration-200">
                                <i class="ri-settings-2-fill mr-3 text-lg"></i>
                                Configuración
                            </a>
                        </li>
                        <li class="mb-3">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center py-2 px-4 text-gray-300 hover:bg-orange-400 hover:text-gray-100 rounded-md transition-colors duration-200"> {{-- onclick="event.preventDefault(); document.getElementById('logout-form').submit();" --}}
                                    <i class="ri-logout-box-line mr-3 text-lg"></i>
                                    <span class="text-sm">Cerrar Sesión</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- end: Sidebar --}}

            <!-- Page Content -->
            <main class="w-[calc(100%-256px)] ml-64 min-h-screen">
                {{ $slot }}
            </main>
        </div>

        {{-- Modal para cerrar sesion --}}
        <div id="logoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white dark:bg-gray-800">
                {{-- Modal header --}}
                <div class="flex justify-between items-center pb-3 border-b dark:border-gray-700">

                </div>
            </div>
        </div>

        <script>
            // Mejorar el dropdown toggle
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(item) {
                const parent = item.closest('.group');
                const menu = parent.querySelector('.sidebar-dropdown-menu');
                const icon = item.querySelector('.sidebar-dropdown-icon');
                
                // Si la ruta actual está en el menú, mantenerlo abierto
                if (menu && menu.querySelector('a[href="' + window.location.pathname + '"]')) {
                    parent.classList.add('selected');
                    if (menu) menu.classList.remove('hidden');
                    if (icon) icon.style.transform = 'rotate(90deg)';
                }
                
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Cerrar otros menús
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(otherItem) {
                        const otherParent = otherItem.closest('.group');
                        const otherMenu = otherParent.querySelector('.sidebar-dropdown-menu');
                        const otherIcon = otherItem.querySelector('.sidebar-dropdown-icon');
                        
                        if (otherParent !== parent && otherParent.classList.contains('selected')) {
                            otherParent.classList.remove('selected');
                            if (otherMenu) otherMenu.classList.add('hidden');
                            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                    
                    // Toggle el menú actual
                    if (parent.classList.contains('selected')) {
                        parent.classList.remove('selected');
                        if (menu) menu.classList.add('hidden');
                        if (icon) icon.style.transform = 'rotate(0deg)';
                    } else {
                        parent.classList.add('selected');
                        if (menu) menu.classList.remove('hidden');
                        if (icon) icon.style.transform = 'rotate(90deg)';
                    }
                });
            });
        </script>
    </body>
</html>
