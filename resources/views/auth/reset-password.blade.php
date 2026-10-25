<x-auth-layout>
    <div class="mb-6">
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-2">
            <i class="ri-lock-unlock-line text-emerald-700"></i> Nueva Clave
        </div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Crear nueva contraseña</h2>
        <p class="mt-1 text-xs text-gray-600 leading-relaxed font-medium">
            Ingresa tu nueva contraseña para acceder nuevamente a tu cuenta en Eat-Cost.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4" x-data="{ showPassword: false, showPasswordConfirmation: false }">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                    value="{{ old('email', $request->email) }}" 
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
            <label for="password" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                Nueva contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                    <i class="ri-lock-line text-base"></i>
                </div>
                <input 
                    id="password" 
                    class="w-full rounded-xl border border-gray-300 bg-white pl-10 pr-10 py-2.5 text-xs text-gray-900 placeholder:text-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 shadow-2xs transition-colors"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    name="password"
                    placeholder="Mínimo 8 caracteres"
                    required 
                    autocomplete="new-password" 
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

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                Confirmar contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                    <i class="ri-lock-check-line text-base"></i>
                </div>
                <input 
                    id="password_confirmation" 
                    class="w-full rounded-xl border border-gray-300 bg-white pl-10 pr-10 py-2.5 text-xs text-gray-900 placeholder:text-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 shadow-2xs transition-colors"
                    x-bind:type="showPasswordConfirmation ? 'text' : 'password'"
                    name="password_confirmation"
                    placeholder="Repite la nueva contraseña"
                    required 
                    autocomplete="new-password" 
                />
                <button 
                    type="button" 
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-700 cursor-pointer"
                    x-on:click="showPasswordConfirmation = !showPasswordConfirmation"
                    tabindex="-1"
                >
                    <i class="text-base" x-bind:class="showPasswordConfirmation ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs" />
        </div>

        <div class="pt-2">
            <button 
                type="submit" 
                class="w-full rounded-xl bg-emerald-600 py-3 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700 active:bg-emerald-800 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="ri-check-line text-sm"></i>
                <span>Restablecer Contraseña</span>
            </button>
        </div>
    </form>
</x-auth-layout>
