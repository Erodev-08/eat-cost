@props(['class' => ''])

<button 
    type="button" 
    onclick="window.toggleDarkMode()" 
    aria-label="Cambiar modo claro / oscuro"
    title="Cambiar tema (Claro / Oscuro)"
    class="p-2 rounded-xl text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-yellow-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 focus:outline-hidden focus:ring-2 focus:ring-emerald-500/20 {{ $class }}"
>
    {{-- Sol visible en modo oscuro --}}
    <i class="ri-sun-line text-lg hidden dark:block text-amber-400"></i>
    {{-- Luna visible en modo claro --}}
    <i class="ri-moon-line text-lg block dark:hidden text-gray-600"></i>
</button>
