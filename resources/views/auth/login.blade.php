<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-7">
        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-600">Acceso</p>
        <h2 class="mt-2 text-3xl font-bold leading-tight text-gray-900">Bienvenido de nuevo</h2>
        <p class="mt-2 text-sm leading-6 text-gray-600">Ingresa tus credenciales para continuar en CulinFinance.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="mb-2 block text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-700">Correo electrónico</label>
            <div class="relative">
                <svg class="absolute left-3.5 top-3.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <x-text-input 
                    id="email" 
                    class="w-full rounded-xl border border-gray-200 bg-white pl-11 pr-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="tu@email.com"
                    required 
                    autofocus 
                    autocomplete="username" 
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="mb-2 block text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-700">Contraseña</label>
            <div class="relative">
                <svg class="absolute left-3.5 top-3.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <x-text-input 
                    id="password" 
                    class="w-full rounded-xl border border-gray-200 bg-white pl-11 pr-11 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-200"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required 
                    autocomplete="current-password" 
                />
                <button type="button" class="absolute right-3.5 top-3.5 text-gray-400 transition hover:text-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-0.5">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-400" name="remember">
                <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-orange-500 hover:text-orange-600" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="mt-2 w-full rounded-xl bg-orange-500 py-3 text-sm font-semibold text-white transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300">
            Iniciar sesión
        </button>

        <!-- Divider -->
        <div class="relative my-1">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-2 bg-white text-gray-500">O continúa con</span>
            </div>
        </div>

        <!-- Social Login -->
        <div class="w-full">
            <button type="button" class="flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                <svg class="h-4 w-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.745 12.27c0-.79-.1-1.54-.25-2.27H12v4.51h6.47c-.29 1.48-1.14 2.73-2.4 3.58v3h3.85c2.27-2.09 3.57-5.17 3.57-8.82z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.85-3c-1.08.72-2.45 1.13-4.08 1.13-3.13 0-5.78-2.11-6.73-4.96h-3.98v3.09C3.05 21.3 7.12 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.27 14.26c-.5-1.48-.5-3.04 0-4.53V6.64H1.29c-.96 2.05-1.5 4.34-1.5 6.64s.54 4.59 1.5 6.64l3.98-3.09z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.95 2.19 15.24 1 12 1 7.12 1 3.05 3.7 1.29 7.36l3.98 3.09c.95-2.85 3.6-4.96 6.73-4.96z"/>
                </svg>
                <span>Google</span>
            </button>
        </div>

        <!-- Register Link -->
        <p class="pt-1 text-center text-sm text-gray-600">
            ¿No tienes cuenta? 
            <a href="{{ route('register') }}" class="font-semibold text-orange-500 hover:text-orange-600">Regístrate</a>
        </p>
    </form>
</x-auth-layout>
