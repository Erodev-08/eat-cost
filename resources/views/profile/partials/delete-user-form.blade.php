<section class="space-y-4">
    <header>
        <h2 class="text-base font-bold text-red-700 flex items-center gap-2">
            <i class="ri-delete-bin-2-line text-red-600"></i>
            Eliminar Cuenta
        </h2>

        <p class="mt-1 text-xs text-gray-600 leading-relaxed">
            Una vez eliminada tu cuenta, todos tus recursos, recetas creadas y cálculos de costos se borrarán permanentemente. Antes de proceder, asegúrate de haber respaldado cualquier dato importante.
        </p>
    </header>

    <div class="pt-2">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            Eliminar Mi Cuenta
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-xl shrink-0">
                    <i class="ri-error-warning-fill"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        ¿Estás seguro de que deseas eliminar tu cuenta?
                    </h2>

                    <p class="mt-1.5 text-xs text-gray-600 leading-relaxed">
                        Esta acción no se puede deshacer. Todos tus datos y recetas se perderán. Por favor, ingresa tu contraseña actual para confirmar la eliminación.
                    </p>
                </div>
            </div>

            <div class="mt-5">
                <x-input-label for="password" value="Contraseña de Confirmación" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Ingresa tu contraseña actual"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
            </div>

            <div class="mt-6 flex justify-end gap-3 pt-3 border-t border-gray-100">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Confirmar Eliminación
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
