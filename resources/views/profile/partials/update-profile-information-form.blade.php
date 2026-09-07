<section>
    <header>
        <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
            <i class="ri-user-3-line text-emerald-600"></i>
            Información del Perfil
        </h2>

        <p class="mt-1 text-xs text-gray-600 leading-relaxed">
            Actualiza el nombre, correo electrónico e institución asociada a tu cuenta.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-5 space-y-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nombre Completo" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-2.5 rounded-xl bg-amber-50 border border-amber-200">
                    <p class="text-xs text-amber-800">
                        Tu dirección de correo aún no ha sido verificada.

                        <button form="send-verification" class="underline text-xs font-bold text-amber-900 hover:text-amber-950 ml-1">
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1.5 font-bold text-xs text-emerald-700">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="institution" value="Institución / Empresa" />
            <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full" :value="old('institution', $user->institution)" placeholder="Ej. Instituto Culinario o Restaurante" />
            <x-input-error class="mt-1.5" :messages="$errors->get('institution')" />
        </div>

        <div class="flex items-center gap-3 pt-2">
            <x-primary-button>Guardar Cambios</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-xs font-bold text-emerald-700 flex items-center gap-1"
                >
                    <i class="ri-checkbox-circle-fill"></i> Guardado correctamente.
                </p>
            @endif
        </div>
    </form>
</section>
