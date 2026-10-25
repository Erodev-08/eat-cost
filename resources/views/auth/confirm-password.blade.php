<x-auth-layout>
    <div class="mb-5">
        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-2">
            <i class="ri-shield-keyhole-line text-emerald-700"></i> Área Protegida
        </div>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Confirma tu contraseña</h2>
        <p class="mt-1.5 text-xs text-gray-600 leading-relaxed font-medium">
            Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">
                Contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                    <i class="ri-lock-line text-base"></i>
                </div>
                <input 
                    id="password" 
                    class="w-full rounded-xl border border-gray-300 bg-white pl-10 pr-4 py-2.5 text-xs text-gray-900 placeholder:text-gray-400 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 shadow-2xs transition-colors"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required 
                    autocomplete="current-password" 
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs" />
        </div>

        <div class="pt-2">
            <button 
                type="submit" 
                class="w-full rounded-xl bg-emerald-600 py-3 text-xs font-bold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700 active:bg-emerald-800 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="ri-check-line text-sm"></i>
                <span>Confirmar y Continuar</span>
            </button>
        </div>
    </form>
</x-auth-layout>
