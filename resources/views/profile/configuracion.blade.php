<x-app-layout>

    {{-- Top Breadcrumb Header Bar --}}
    <div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 py-3 px-6 flex items-center justify-between">
        <div class="flex items-center space-x-2 text-xs">
            <a href="{{ route('dashboard') }}" class="text-emerald-700 dark:text-emerald-400 font-bold uppercase tracking-wider hover:underline">Eat-Cost</a>
            <span class="text-gray-300 dark:text-gray-600">/</span>
            <a href="{{ route('profile.user') }}" class="text-gray-500 dark:text-gray-400 hover:text-emerald-700 dark:hover:text-emerald-400">Usuario</a>
            <span class="text-gray-300 dark:text-gray-600">/</span>
            <span class="text-gray-800 dark:text-gray-200 font-semibold">Configuración</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        
        <div class="mb-2">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="ri-settings-3-line text-emerald-600 dark:text-emerald-400"></i>
                Configuración de la Cuenta
            </h1>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                Ajustes, apariencia, seguridad y opciones de cuenta en Eat-Cost
            </p>
        </div>

        {{-- Apartado de Modo Claro / Modo Oscuro --}}
        <div class="p-6 bg-white dark:bg-gray-800 shadow-xs border border-gray-200/80 dark:border-gray-700/80 rounded-2xl"
             x-data="{
                currentTheme: localStorage.getItem('theme') || 'system',
                setTheme(theme) {
                    this.currentTheme = theme;
                    if (theme === 'system') {
                        localStorage.removeItem('theme');
                        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    } else {
                        localStorage.setItem('theme', theme);
                        if (theme === 'dark') {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    }
                }
             }">
            <div class="flex items-center gap-2.5 mb-4">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-base">
                    <i class="ri-contrast-2-line"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Apariencia y Tema</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Personaliza la interfaz visual de Eat-Cost entre modo claro y oscuro</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 pt-2">
                {{-- Opción Modo Claro --}}
                <button type="button"
                        @click="setTheme('light')"
                        :class="currentTheme === 'light' ? 'border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/20 ring-2 ring-emerald-500/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 bg-white dark:bg-gray-800/60'"
                        class="p-4 rounded-xl border text-left flex items-start gap-3 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <i class="ri-sun-fill text-lg"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-1.5">
                            Modo Claro
                            <i x-show="currentTheme === 'light'" class="ri-checkbox-circle-fill text-emerald-600 text-xs"></i>
                        </p>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Fondo blanco luminoso para el día.</p>
                    </div>
                </button>

                {{-- Opción Modo Oscuro --}}
                <button type="button"
                        @click="setTheme('dark')"
                        :class="currentTheme === 'dark' ? 'border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/20 ring-2 ring-emerald-500/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 bg-white dark:bg-gray-800/60'"
                        class="p-4 rounded-xl border text-left flex items-start gap-3 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gray-900 text-indigo-300 flex items-center justify-center shrink-0">
                        <i class="ri-moon-fill text-lg"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-1.5">
                            Modo Oscuro
                            <i x-show="currentTheme === 'dark'" class="ri-checkbox-circle-fill text-emerald-600 text-xs"></i>
                        </p>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Fondo oscuro ideal para entornos con poca luz.</p>
                    </div>
                </button>

                {{-- Opción Modo Sistema --}}
                <button type="button"
                        @click="setTheme('system')"
                        :class="currentTheme === 'system' ? 'border-emerald-600 bg-emerald-50/50 dark:bg-emerald-950/20 ring-2 ring-emerald-500/20' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600 bg-white dark:bg-gray-800/60'"
                        class="p-4 rounded-xl border text-left flex items-start gap-3 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="ri-computer-line text-lg"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-1.5">
                            Sistema
                            <i x-show="currentTheme === 'system'" class="ri-checkbox-circle-fill text-emerald-600 text-xs"></i>
                        </p>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">Se adapta a la configuración de tu equipo.</p>
                    </div>
                </button>
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 shadow-xs border border-gray-200/80 dark:border-gray-700/80 rounded-2xl">
            <div class="flex items-center gap-2.5 mb-4">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-base">
                    <i class="ri-shield-keyhole-line"></i>
                </div>
                <h2 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Estado de Seguridad</h2>
            </div>

            <div class="space-y-3">
                @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && $user->hasVerifiedEmail())
                    <div class="flex items-start gap-2.5">
                        <div class="shrink-0 w-5 h-5 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-sm mt-0.5">
                            <i class="ri-check-line font-bold"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Email Verificado</p>
                            <p class="text-[11px] text-gray-600 dark:text-gray-400 font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-start gap-2.5">
                        <div class="shrink-0 w-5 h-5 rounded-full bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-400 flex items-center justify-center text-sm mt-0.5">
                            <i class="ri-alert-line font-bold"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Email No Verificado</p>
                                <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-bold text-emerald-700 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 hover:underline">Verificar</button>
                                </form>
                            </div>
                            <p class="text-[11px] text-gray-600 dark:text-gray-400 font-medium truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                @endif

                <div class="flex items-start gap-2.5">
                    <div class="shrink-0 w-5 h-5 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-sm mt-0.5">
                        <i class="ri-check-line font-bold"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Contraseña Segura</p>
                        <p class="text-[11px] text-gray-600 dark:text-gray-400 font-medium">Encriptación de nivel bancario</p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5">
                    <div class="shrink-0 w-5 h-5 rounded-full {{ $profile && $profile->profile ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-400' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} flex items-center justify-center text-sm mt-0.5">
                        <i class="{{ $profile && $profile->profile ? 'ri-check-line font-bold' : 'ri-information-line' }}"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Foto de Perfil</p>
                        <p class="text-[11px] text-gray-600 dark:text-gray-400 font-medium">{{ $profile && $profile->profile ? 'Foto personalizada' : 'Avatar automático' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 shadow-xs border border-gray-200/80 dark:border-gray-700/80 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white dark:bg-gray-800 shadow-xs border border-gray-200/80 dark:border-gray-700/80 rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</x-app-layout>
