@php
    $items = [
        [
            'route'     => route('home'),
            'active'    => request()->routeIs('home'),
            'name'      => __('Inicio')
        ],
        [
            'route'     => route('recetas'),
            'active'    => request()->routeIs('recetas'),
            'name'      => __('Recetas') 
        ],
        [
            'route'     => route('recetas.elaboradas.index'),
            'active'    => request()->routeIs('recetas.elaboradas.*'),
            'name'      => __('Costeo & Mermas')
        ]
    ];
@endphp

<nav class="bg-white/95 backdrop-blur-xs fixed w-full z-30 top-0 start-0 border-b border-gray-200 shadow-xs">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">
        
        {{-- Logo Eat-Cost --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-sm">
                <i class="ri-restaurant-line text-lg"></i>
            </div>
            <div>
                <div class="text-xl font-bold tracking-tight text-gray-900">
                    <span class="text-emerald-700 font-extrabold">Eat</span><span class="text-gray-300 font-light mx-0.5">•</span><span class="text-emerald-500 font-semibold">Cost</span>
                </div>
            </div>
        </a>
        
        {{-- Botones de la derecha --}}
        @if (Route::has('login'))
            <div class="flex items-center md:order-2 space-x-2.5">
                @auth
                    <div class="relative">
                        <button type="button" 
                                class="dropdown-btn flex items-center gap-2 px-3 py-1.5 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-150">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="ri-arrow-down-s-line text-xs transition-transform duration-150 dropdown-icon"></i>
                        </button>
                        
                        <div class="dropdown-menu absolute right-0 z-50 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 opacity-0 invisible transition-all duration-150 transform -translate-y-2 p-1.5">
                            <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg transition duration-150">
                                <i class="ri-home-5-line text-emerald-600"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('profile.user') }}" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg transition duration-150">
                                <i class="ri-user-line text-emerald-600"></i>
                                Mi Perfil
                            </a>

                            <a href="{{ route('recetas') }}" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 rounded-lg transition duration-150">
                                <i class="ri-book-open-line text-emerald-600"></i>
                                Recetas
                            </a>
                            
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition duration-150 text-left">
                                    <i class="ri-logout-box-r-line"></i>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex md:space-x-2">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-emerald-700 px-3.5 py-1.5 rounded-lg text-sm font-semibold transition duration-150">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="text-white bg-emerald-600 hover:bg-emerald-700 px-3.5 py-1.5 rounded-lg text-sm font-semibold shadow-xs transition duration-150">
                            Regístrate
                        </a>
                    </div>
                @endauth
               
                {{-- Menú móvil --}}
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-1.5 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 transition duration-150" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Abrir menú</span>
                    <i class="ri-menu-line text-lg"></i>
                </button>
            </div>
        @endif
        
        {{-- Enlaces de navegación --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky"> 
            <ul class="flex flex-col p-4 md:p-0 mt-3 md:space-x-6 md:flex-row md:mt-0 font-medium text-sm">
                @foreach ($items as $item)
                    <li>
                        <a href="{{ $item['route'] }}" 
                        class="block py-1.5 px-2.5 rounded-lg transition duration-150 
                        {{ $item['active'] 
                            ? 'text-emerald-700 bg-emerald-50 md:bg-transparent font-bold' 
                            : 'text-gray-600 hover:text-emerald-700 hover:bg-gray-50 md:hover:bg-transparent' 
                        }}">
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach

                @guest
                    <li class="md:hidden space-y-1.5 mt-2 pt-2 border-t border-gray-100">
                        <a href="{{ route('login') }}" class="block text-center py-2 px-3 text-gray-700 bg-gray-100 rounded-lg text-sm font-semibold">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="block text-center py-2 px-3 text-white bg-emerald-600 rounded-lg text-sm font-semibold">
                            Registrarse
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownBtns = document.querySelectorAll('.dropdown-btn');

        dropdownBtns.forEach(btn => {
            const dropdown = btn.parentElement.querySelector('.dropdown-menu');
            const icon = btn.querySelector('.dropdown-icon');

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = dropdown.classList.contains('opacity-100');

                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('opacity-100', 'visible');
                        menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                        const otherIcon = menu.closest('.relative')?.querySelector('.dropdown-icon');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });

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
