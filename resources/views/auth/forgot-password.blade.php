<x-auth-layout>
    <div class="mb-7">
        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-600">Recuperar contraseña</p>
        <h2 class="mt-2 text-3xl font-bold leading-tight text-gray-900">¿Olvidaste tu contraseña?</h2>
        <p class="mt-2 text-sm leading-6 text-gray-600">No te preocupes, ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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

        <div>
            <button 
                type="submit" 
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 focus:ring-offset-gray-100">
                {{ __('Enviar enlace de restablecimiento') }}
            </button>
        </div>
    </form>
</x-auth-layout>
