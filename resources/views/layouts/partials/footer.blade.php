<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-auto transition-colors duration-200">
    <div class="max-w-screen-xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            
            {{-- Logo & Brand --}}
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-base shadow-xs">
                    <i class="ri-restaurant-line"></i>
                </div>
                <div>
                    <span class="text-base font-bold text-gray-900 dark:text-white">
                        <span class="text-emerald-700 dark:text-emerald-400 font-black">Eat</span><span class="text-gray-300 dark:text-gray-600 font-light mx-0.5">•</span><span class="text-emerald-500 font-semibold">Cost</span>
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-2 font-medium">Costeo Culinario Inteligente</span>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs font-semibold text-gray-600 dark:text-gray-300">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Inicio</a>
                <a href="{{ route('recetas') }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Recetas</a>
                <a href="{{ route('recetas.elaboradas.index') }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Costeo & Mermas</a>
                <a href="{{ route('terms.show') }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Términos</a>
                <a href="{{ route('privacy.show') }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Privacidad</a>
            </div>

            {{-- Copyright --}}
            <div class="text-xs text-gray-500 dark:text-gray-400 text-center md:text-right">
                <p>&copy; {{ date('Y') }} <strong>Eat-Cost</strong>. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>
