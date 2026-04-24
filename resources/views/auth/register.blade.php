<x-auth-layout>
    <div
        x-data="{
            showPassword: false,
            showPasswordConfirmation: false,
            password: '',
            passwordConfirmation: '',
            acceptedTerms: {{ old('terms') ? 'true' : 'false' }},
            normalizeName(event) {
                const cleaned = event.target.value.replace(/[^\p{L}\s'’]/gu, '').replace(/\s+/g, ' ').trimStart();
                event.target.value = cleaned.replace(/\b\p{L}/gu, (char) => char.toLocaleUpperCase());
            },
            strengthScore() {
                let score = 0;
                if (this.password.length >= 8) score++;
                if (/[a-z]/.test(this.password)) score++;
                if (/[A-Z]/.test(this.password)) score++;
                if (/[0-9]/.test(this.password)) score++;
                if (/[^A-Za-z0-9]/.test(this.password)) score++;

                return score;
            },
            strengthLabel() {
                const labels = ['Muy debil', 'Debil', 'Media', 'Buena', 'Fuerte', 'Muy fuerte'];
                return labels[this.strengthScore()];
            },
            strengthColor() {
                const colors = ['#dc2626', '#ea580c', '#d97706', '#65a30d', '#16a34a', '#15803d'];
                return colors[this.strengthScore()];
            },
            strengthWidth() {
                return `${(this.strengthScore() / 5) * 100}%`;
            },
            passwordsMatch() {
                return this.passwordConfirmation.length === 0 || this.password === this.passwordConfirmation;
            }
        }"
    >
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Crea tu cuenta</h2>
            <p class="text-sm text-gray-600 mt-1">Únete a chefs financieramente inteligentes</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Nombre completo</label>
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <x-text-input
                        id="name"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        type="text"
                        name="name"
                        :value="old('name')"
                        placeholder="Juan Pérez O'Connor"
                        required
                        autofocus
                        autocomplete="name"
                        x-on:input="normalizeName($event)"
                        pattern="^[\p{L}]+(?:[\s'’][\p{L}]+)*$"
                    />
                </div>
                <p class="mt-1 text-xs text-gray-500">Solo letras, espacios y apóstrofo ('). Las iniciales se capitalizan automáticamente.</p>
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Correo electrónico</label>
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <x-text-input
                        id="email"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="tu@email.com"
                        required
                        autocomplete="username"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <div>
                <label for="institution_name" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Institución</label>
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 20.055 12.083 12.083 0 015.84 10.578L12 14z" />
                    </svg>
                    <x-text-input
                        id="institution_name"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        type="text"
                        name="institution_name"
                        :value="old('institution_name')"
                        placeholder="Universidad de Colima"
                        autocomplete="organization"
                    />
                </div>
                <x-input-error :messages="$errors->get('institution_name')" class="mt-1 text-xs" />
            </div>

            <div>
                <label for="faculty_name" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Facultad</label>
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 8h10M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                    </svg>
                    <x-text-input
                        id="faculty_name"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        type="text"
                        name="faculty_name"
                        :value="old('faculty_name')"
                        placeholder="Turismo y Gastronomía"
                        autocomplete="organization"
                    />
                </div>
                <x-input-error :messages="$errors->get('faculty_name')" class="mt-1 text-xs" />
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Contraseña</label>
                <div class="relative">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <x-text-input
                        id="password"
                        class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        x-model="password"
                    />
                    <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600" x-on:click="showPassword = !showPassword">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-2 rounded-lg border border-gray-200 p-3">
                    <div class="h-2 w-full rounded-full bg-gray-200 overflow-hidden">
                        <div class="h-2 rounded-full transition-all duration-300" x-bind:style="`width: ${strengthWidth()}; background-color: ${strengthColor()}`"></div>
                    </div>
                    <p class="mt-2 text-xs font-semibold" x-bind:style="`color: ${strengthColor()}`" x-text="`Potencia: ${strengthLabel()}`"></p>
                    <ul class="mt-2 space-y-1 text-xs text-gray-500">
                        <li>Tenga 8 caracteres como mínimo.</li>
                        <li>Debe incluir mayúsculas, minúsculas, números y símbolos.</li>
                        <li>A mayor cantidad de caracteres, mayor es la seguridad.</li>
                    </ul>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-900 mb-1.5 uppercase tracking-wide">Confirmar contraseña</label>
                <div class="relative">
                    <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <x-text-input
                        id="password_confirmation"
                        class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        x-bind:type="showPasswordConfirmation ? 'text' : 'password'"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        x-model="passwordConfirmation"
                    />
                    <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600" x-on:click="showPasswordConfirmation = !showPasswordConfirmation">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <p class="mt-1 text-xs" x-show="!passwordsMatch()" x-cloak style="color: #dc2626;">Las contraseñas no coinciden.</p>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
            </div>

            <div class="flex items-start pt-1">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    value="1"
                    x-model="acceptedTerms"
                    required
                    class="mt-0.5 rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500 h-3.5 w-3.5"
                >
                <label for="terms" class="ms-2.5 text-xs text-gray-600">
                    Acepto
                    <button
                        type="button"
                        class="text-orange-500 hover:text-orange-600 font-semibold underline-offset-2 hover:underline"
                        x-on:click.prevent="$dispatch('open-modal', 'terms-modal')"
                    >
                        términos
                    </button>
                    y
                    <button
                        type="button"
                        class="text-orange-500 hover:text-orange-600 font-semibold underline-offset-2 hover:underline"
                        x-on:click.prevent="$dispatch('open-modal', 'privacy-modal')"
                    >
                        privacidad
                    </button>
                </label>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-1 text-xs" />

            <button
                type="submit"
                class="w-full text-white text-sm font-semibold py-2.5 rounded-lg transition duration-200 mt-5"
                x-bind:disabled="!acceptedTerms"
                x-bind:class="acceptedTerms ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-300 cursor-not-allowed'"
            >
                Crear cuenta
            </button>

            <p class="text-center text-xs text-gray-600 pt-1">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-semibold">Inicia sesión</a>
            </p>
        </form>

        <x-modal name="terms-modal" :show="false" maxWidth="2xl">
            <div class="p-6 sm:p-7">
                <h3 class="text-lg font-bold text-gray-900">Términos del sitio</h3>
                <p class="mt-4 text-sm leading-7 text-gray-700">
                    Al usar este sitio, aceptas un uso responsable de la plataforma y de la información compartida en ella.
                    Nuestro objetivo es educativo y de apoyo para estudiantes y usuarios del entorno culinario y financiero.
                </p>
                <p class="mt-3 text-sm leading-7 text-gray-700">
                    No se hará ningún uso mal intencionado de los datos de los usuarios. El sitio no promueve ni vende
                    datos personales de los usuarios.
                </p>
                <p class="mt-3 text-sm leading-7 text-gray-700">
                    Este sitio respeta el derecho a la privacidad de los datos personales y actúa conforme a las leyes
                    aplicables de protección de datos y privacidad.
                </p>

                <div class="mt-6 flex justify-end">
                    <button
                        type="button"
                        class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600"
                        x-on:click="$dispatch('close-modal', 'terms-modal')"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </x-modal>

        <x-modal name="privacy-modal" :show="false" maxWidth="2xl">
            <div class="p-6 sm:p-7">
                <h3 class="text-lg font-bold text-gray-900">Política de privacidad</h3>
                <p class="mt-4 text-sm leading-7 text-gray-700">
                    La información proporcionada por los usuarios se utiliza únicamente para el funcionamiento del sitio
                    y para mejorar la experiencia dentro de la plataforma.
                </p>
                <p class="mt-3 text-sm leading-7 text-gray-700">
                    No se hará ningún uso mal intencionado de los datos de los usuarios. Este sitio no promueve ni vende
                    datos personales de los usuarios.
                </p>
                <p class="mt-3 text-sm leading-7 text-gray-700">
                    Se reconoce y respeta el derecho a la privacidad de los datos personales, conforme a las leyes
                    aplicables en materia de protección de datos.
                </p>

                <div class="mt-6 flex justify-end">
                    <button
                        type="button"
                        class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600"
                        x-on:click="$dispatch('close-modal', 'privacy-modal')"
                    >
                        Cerrar
                    </button>
                </div>
            </div>
        </x-modal>
    </div>
</x-auth-layout>
