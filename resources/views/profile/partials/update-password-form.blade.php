<section>
    <header>
        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
            <i class="ri-lock-password-line text-emerald-600"></i>
            Actualizar Contraseña
        </h2>

        <p class="mt-1 text-xs text-gray-600 leading-relaxed">
            Asegúrate de que tu cuenta utilice una contraseña segura y difícil de adivinar para proteger tus recetas y costos.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-5 space-y-4">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Contraseña Actual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nueva Contraseña" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirmar Nueva Contraseña" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Repite la nueva contraseña" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="flex items-center gap-3 pt-2">
            <x-primary-button>Actualizar Contraseña</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-xs font-bold text-emerald-700 flex items-center gap-1"
                >
                    <i class="ri-checkbox-circle-fill"></i> Contraseña actualizada correctamente.
                </p>
            @endif
        </div>
    </form>
</section>
