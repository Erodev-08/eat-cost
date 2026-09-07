<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('error'))
        <div class="mb-4 flex items-center gap-2 rounded-xl bg-red-50 border border-red-200 p-3 text-xs font-medium text-red-700">
            <i class="ri-error-warning-line text-base text-red-500 shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="mb-5">
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-2">
            <i class="ri-shield-keyhole-line text-emerald-700"></i> Acceso Seguro
        </div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Bienvenido de nuevo</h2>
        <p class="mt-1 text-xs text-gray-600 leading-relaxed font-medium">
            Ingresa tus credenciales para acceder a tus recetas y costeos en <strong>Eat-Cost</strong>.
        </p>
    </div>

    

    <!-- Divider -->
    <div class="relative my-4">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="bg-white px-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">o con tu correo</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4" x-data="{ showPassword: false }">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                Correo electrónico
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                    <i class="ri-mail-line text-base"></i>
                </div>
                <input 
                    id="email" 
                    class="w-full rounded-xl border border-gray-300 bg-white pl-10 pr-4 py-2.5 text-xs text-gray-900 placeholder:text-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 shadow-2xs transition-colors" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="chef@ejemplo.com"
                    required 
                    autofocus 
                    autocomplete="username" 
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-bold text-gray-800 uppercase tracking-wider">
                    Contraseña
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                    <i class="ri-lock-line text-base"></i>
                </div>
                <input 
                    id="password" 
                    class="w-full rounded-xl border border-gray-300 bg-white pl-10 pr-10 py-2.5 text-xs text-gray-900 placeholder:text-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 shadow-2xs transition-colors"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password"
                    placeholder="••••••••"
                    required 
                    autocomplete="current-password" 
                />
                <button 
                    type="button" 
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-700 cursor-pointer"
                    x-on:click="showPassword = !showPassword"
                    tabindex="-1"
                >
                    <i class="text-base" x-bind:class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-emerald-600 shadow-xs focus:ring-emerald-500 cursor-pointer" name="remember">
                <span class="ms-2 text-xs font-medium text-gray-700">Mantener sesión iniciada</span>
            </label>
        </div>

        <!-- Login Button -->
        <div class="pt-2">
            <button type="submit" class="w-full rounded-xl bg-emerald-600 py-3 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700 active:bg-emerald-800 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="ri-login-box-line text-sm"></i>
                <span>Iniciar Sesión</span>
            </button>
        </div>

        <!-- Register Link -->
        <div class="pt-3 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-600">
                ¿Aún no tienes cuenta? 
                <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 hover:underline">
                    Regístrate gratis
                </a>
            </p>
        </div>
    </form>
</x-auth-layout>
