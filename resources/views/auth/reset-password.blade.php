<x-auth-layout>
    <div class="mb-7">
        <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-600">Restablecer contraseña</p>
        <h2 class="mt-2 text-3xl font-bold leading-tight text-gray-900">Crear nueva contraseña</h2>
        <p class="mt-2 text-sm leading-6 text-gray-600">Ingresa tu nueva contraseña para acceder a tu cuenta.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                    :value="old('email', $request->email)" 
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
            <label for="password" class="mb-2 block text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-700">Nueva contraseña</label>
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
                    autocomplete="new-password" 
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="mb-2 block text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-700">Confirmar contraseña</label>
            <div class="relative">
                <svg class="absolute left-3.5 top-3.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <x-text-input 
                    id="password_confirmation" 
                    class="w-full rounded-xl border border-gray-200 bg-white pl-11 pr-11 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-200"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required 
                    autocomplete="new-password" 
                />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <div>
            <button 
                type="submit" 
                class="mt-2 w-full rounded-xl bg-orange-500 py-3 text-sm font-semibold text-white transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300">
                {{ __('Restablecer contraseña') }}
            </button>
        </div>
    </form>
</x-auth-layout>
