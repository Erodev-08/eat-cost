@php
    $items = [
        [
            'route'     => route('home'),
            'active'    => request()->routeIs('home'),
            'name'      => __('Home')
        ],
        [
            'route'     => route('recetas'),
            'active'    => request()->routeIs('recetas'),
            'name'      => __('Recetas') 
        ],
        [
        'route'     => route('recetas.elaboradas.index'),
        'active'    => request()->routeIs('recetas.elaboradas.*'),
        'name'      => __('Mis recetas')
        ],
        [
            'route'     => route('contact'),
            'active'    => request()->routeIs('contact'),
            'name'      => __('Contacto')
        ]
    ];
@endphp

<nav class="bg-blue-50 fixed w-full z-20 top-0 start-0 border-b border-default shadow-sm">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2 md:p-auto">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-sm ring-1 ring-white/20">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M7 20h10a2 2 0 0 0 2-2v-4H5v4a2 2 0 0 0 2 2Z" />
                    <path d="M7 14c0-2 1.5-3.5 3.5-3.5h3c2 0 3.5 1.5 3.5 3.5" />
                    <path d="M8 10.5c0-2 1.2-3.7 3-4.5" />
                    <path d="M16 10.5c0-2-1.2-3.7-3-4.5" />
                </svg>
			</div>
            <div>
				<div class="text-2xl font-bold tracking-tight">Eat Cost</div>
			</div>
        </a>
        
        {{-- Botones de la derecha y menú hamburguesa --}}
        @if (Route::has('login'))
            <div class="flex items-center md:order-2 space-x-3">
                @auth
                    <div class="relative">
                        <button type="button" 
                                class="dropdown-btn flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-200">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div class="dropdown-menu absolute right-0 z-50 mt-3 md:mt-9 w-48 bg-blue-50 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 opacity-0 invisible transition-all duration-200 transform -translate-y-2">
                            <div class="py-4">
                                <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-white transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                
                                <a href="{{ route('profile.user') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-white transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Perfil
                                </a>
                                
                                <div class="border-t border-gray-100 my-1"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-100 transition duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Botones visibles solo en desktop --}}
                    <div class="hidden md:flex md:space-x-3">
                        <button type="button" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition duration-200" onclick="window.location.href='{{ route('login') }}'">
                            Inicia Sesión
                        </button>
                        <button type="button" class="text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded-lg text-sm font-medium transition duration-200" onclick="window.location.href='{{ route('register') }}'">
                            Regístrate
                        </button>
                    </div>
                @endauth
               
                {{-- Botón menú hamburguesa (siempre visible en móvil) --}}
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-600 rounded-lg md:hidden hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Abrir menú</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                    </svg>
                </button>
            </div>
        @endif
        
        {{-- Menú de navegación responsive (incluye enlaces y botones de autenticación) --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky"> 
            <ul class="flex flex-col px-4 py-5 font-medium rounded-lg md:space-x-9 rtl:space-x-reverse md:flex-row md:mt-0 md:bg-transparent">
                {{-- Enlaces de navegación --}}
                @foreach ($items as $item)
                    <li>
                        <a href="{{ $item['route'] }}" 
                        class="block py-2 px-3 mt-3 rounded-lg transition duration-300 
                        {{ $item['active'] 
                            ? 'text-white bg-blue-600 md:bg-blue-600 md:text-white' 
                            : 'text-gray-700 hover:text-blue-600 md:hover:bg-transparent md:hover:text-blue-600' 
                        }} md:py-2 md:px-3">
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
                  {{-- Botones de login/registro exclusivos para el menú responsive --}}
                  <li class="md:hidden space-y-2 mt-2 pt-2 border-t border-gray-200">
                      <a href="{{ route('login') }}" class="block py-2 px-3 mt-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium transition duration-200">
                          Inicia Sesion
                      </a>
                      <a href="{{ route('register') }}" class="block py-2 px-3 mt-3 text-white bg-teal-600 hover:bg-teal-700 rounded-lg text-sm font-medium transition duration-200">
                          Registrate
                      </a>
                  </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Script para el menú móvil --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar todos los dropdowns en la página
        const dropdownBtns = document.querySelectorAll('.dropdown-btn');

        dropdownBtns.forEach(btn => {
            const dropdown = btn.parentElement.querySelector('.dropdown-menu');
            const icon = btn.querySelector('.dropdown-icon');

            // Toggle dropdown al hacer click
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = dropdown.classList.contains('opacity-100');

                // Cerrar todos los dropdowns primero
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('opacity-100', 'visible');
                        menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                        const otherIcon = menu.closest('.relative')?.querySelector('.dropdown-icon');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });

                // Toggle el actual
                if (!isOpen) {
                    dropdown.classList.remove('opacity-0', 'invisible', '-translate-y-2');
                    dropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                } else {
                    dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    dropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                }
            });
        });

        // Cerrar dropdown al hacer click fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    const icon = menu.closest('.relative')?.querySelector('.dropdown-icon');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                });
            }
        });
    });

    // Script para el menú hamburguesa
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
        const menu = document.getElementById('navbar-sticky');

        if (menuButton && menu) {
            menuButton.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                const expanded = menu.classList.contains('hidden') ? 'false' : 'true';
                menuButton.setAttribute('aria-expanded', expanded);
            });
        }
    });
</script>
