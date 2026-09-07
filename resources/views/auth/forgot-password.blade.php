<x-auth-layout>
    <div class="mb-6">
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-2">
            <i class="ri-key-line text-emerald-700"></i> Recuperación
        </div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">¿Olvidaste tu contraseña?</h2>
        <p class="mt-1 text-xs text-gray-600 leading-relaxed font-medium">
            Ingresa tu correo electrónico registrado y te enviaremos un enlace seguro para restablecer tu contraseña.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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

        <div class="pt-2">
            <button 
                type="submit" 
                class="w-full rounded-xl bg-emerald-600 py-3 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700 active:bg-emerald-800 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="ri-send-plane-line text-sm"></i>
                <span>Enviar Enlace de Recuperación</span>
            </button>
        </div>

        <div class="pt-3 border-t border-gray-100 text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline">
                <i class="ri-arrow-left-s-line text-sm"></i> Volver a Iniciar Sesión
            </a>
        </div>
    </form>
</x-auth-layout>
